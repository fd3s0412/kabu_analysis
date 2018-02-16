using System.Runtime.InteropServices;
using System.Threading;
using System.Windows.Forms;

class MouseService
{
    [DllImport("USER32.dll", CallingConvention = CallingConvention.StdCall)]
    static extern void SetCursorPos(int X, int Y);

    [DllImport("USER32.dll", CallingConvention = CallingConvention.StdCall)]
    static extern void mouse_event(int dwFlags, int dx, int dy, int cButtons, int dwExtraInfo);

    // マウスイベント(mouse_eventの引数と同様のデータ)
    [StructLayout(LayoutKind.Sequential)]
    private struct MOUSEINPUT
    {
        public int dx;
        public int dy;
        public int mouseData;
        public int dwFlags;
        public int time;
        public int dwExtraInfo;
    };

    // キーボードイベント(keybd_eventの引数と同様のデータ)
    [StructLayout(LayoutKind.Sequential)]
    private struct KEYBDINPUT
    {
        public short wVk;
        public short wScan;
        public int dwFlags;
        public int time;
        public int dwExtraInfo;
    };

    // ハードウェアイベント
    [StructLayout(LayoutKind.Sequential)]
    private struct HARDWAREINPUT
    {
        public int uMsg;
        public short wParamL;
        public short wParamH;
    };

    // 各種イベント(SendInputの引数データ)
    [StructLayout(LayoutKind.Explicit)]
    private struct INPUT
    {
        [FieldOffset(0)]
        public int type;
        [FieldOffset(4)]
        public MOUSEINPUT mi;
        [FieldOffset(4)]
        public KEYBDINPUT ki;
        [FieldOffset(4)]
        public HARDWAREINPUT hi;
    };

    [DllImport("user32.dll")]
    private extern static void SendInput(int nInputs, ref INPUT pInputs, int cbsize);

    // 仮想キーコードをスキャンコードに変換
    [DllImport("user32.dll", EntryPoint = "MapVirtualKeyA")]
    private extern static int MapVirtualKey(int wCode, int wMapType);

    private const int INPUT_MOUSE = 0;                  // マウスイベント
    private const int INPUT_KEYBOARD = 1;               // キーボードイベント
    private const int INPUT_HARDWARE = 2;               // ハードウェアイベント

    private const int MOUSEEVENTF_MOVE = 0x1;           // マウスを移動する
    private const int MOUSEEVENTF_ABSOLUTE = 0x8000;    // 絶対座標指定
    private const int MOUSEEVENTF_LEFTDOWN = 0x2;       // 左　ボタンを押す
    private const int MOUSEEVENTF_LEFTUP = 0x4;         // 左　ボタンを離す
    private const int MOUSEEVENTF_RIGHTDOWN = 0x8;      // 右　ボタンを押す
    private const int MOUSEEVENTF_RIGHTUP = 0x10;       // 右　ボタンを離す
    private const int MOUSEEVENTF_MIDDLEDOWN = 0x20;    // 中央ボタンを押す
    private const int MOUSEEVENTF_MIDDLEUP = 0x40;      // 中央ボタンを離す
    private const int MOUSEEVENTF_WHEEL = 0x800;        // ホイールを回転する
    private const int WHEEL_DELTA = 120;                // ホイール回転値

    public int KEYEVENTF_KEYDOWN = 0x0;          // キーを押す
    public int KEYEVENTF_KEYUP = 0x2;            // キーを離す
    private const int KEYEVENTF_EXTENDEDKEY = 0x1;      // 拡張コード
    private const int VK_SHIFT = 0x10;                  // SHIFTキー

    private const int KBD_UNICODE = 0x0004;

    /// <summary>
    /// 指定座標を左クリックします.
    /// </summary>
    /// <param name="x"></param>
    /// <param name="y"></param>
    public void ClickLeft(int x, int y)
    {
        System.Random r = new System.Random();
        x += r.Next(10);
        y += r.Next(5);

        SetCursorPos(x, y);
        mouse_event(MOUSEEVENTF_LEFTDOWN, 0, 0, 0, 0);
        mouse_event(MOUSEEVENTF_LEFTUP, 0, 0, 0, 0);
    }

    /// <summary>
    /// 指定座標を右クリックする.
    /// </summary>
    /// <param name="x"></param>
    /// <param name="y"></param>
    public void ClickRight(int x, int y)
    {
        System.Random r = new System.Random();
        x += r.Next(10);
        y += r.Next(5);

        // マウス操作実行用のデータ
        const int num = 3;
        INPUT[] inp = new INPUT[num];

        // (1)マウスカーソルを移動する(スクリーン座標でX座標=800ピクセル,Y=400ピクセルの位置)
        inp[0].type = INPUT_MOUSE;
        inp[0].mi.dwFlags = MOUSEEVENTF_MOVE | MOUSEEVENTF_ABSOLUTE;
        inp[0].mi.dx = x * (65535 / Screen.PrimaryScreen.Bounds.Width);
        inp[0].mi.dy = y * (65535 / Screen.PrimaryScreen.Bounds.Height);
        inp[0].mi.mouseData = 0;
        inp[0].mi.dwExtraInfo = 0;
        inp[0].mi.time = 0;

        // (2)マウスの右ボタンを押す
        inp[1].type = INPUT_MOUSE;
        inp[1].mi.dwFlags = MOUSEEVENTF_RIGHTDOWN;
        inp[1].mi.dx = 0;
        inp[1].mi.dy = 0;
        inp[1].mi.mouseData = 0;
        inp[1].mi.dwExtraInfo = 0;
        inp[1].mi.time = 0;

        // (3)マウスの右ボタンを離す
        inp[2].type = INPUT_MOUSE;
        inp[2].mi.dwFlags = MOUSEEVENTF_RIGHTUP;
        inp[2].mi.dx = 0;
        inp[2].mi.dy = 0;
        inp[2].mi.mouseData = 0;
        inp[2].mi.dwExtraInfo = 0;
        inp[2].mi.time = 0;

        // マウス操作実行
        SendInput(num, ref inp[0], Marshal.SizeOf(inp[0]));
    }

    public void DragAndDropLeft(int x, int y)
    {
        System.Random r = new System.Random();
        int dragStartX = r.Next(30) + Screen.PrimaryScreen.Bounds.Width / 2;
        int dragStartY = r.Next(20) + Screen.PrimaryScreen.Bounds.Height / 2;

        SetCursorPos(dragStartX, dragStartY);
        mouse_event(MOUSEEVENTF_LEFTDOWN, 0, 0, 0, 0);

        x += r.Next(30);
        y += r.Next(20);
        Thread.Sleep(500);
        SetCursorPos(dragStartX + x, dragStartY + y);
        Thread.Sleep(500);
        mouse_event(MOUSEEVENTF_LEFTUP, 0, 0, 0, 0);
    }

    /// <summary>
    /// 指定キーを操作する.
    /// </summary>
    public void SendInputKey(int flags, System.Windows.Forms.Keys key)
    {
        int keyboardFlags = (int)flags | KBD_UNICODE;
        short virtualKey = (short)key;
        short scanCode = (short)MapVirtualKey(virtualKey, 0);

        const int num = 1;
        INPUT[] inp = new INPUT[num];

        inp[0].type = INPUT_KEYBOARD;
        inp[0].ki.dwFlags = keyboardFlags;
        inp[0].ki.wVk = virtualKey;
        inp[0].ki.wScan = scanCode;
        inp[0].ki.time = 0;
        inp[0].ki.dwExtraInfo = 0;

        SendInput(num, ref inp[0], Marshal.SizeOf(inp[0]));
    }
}
