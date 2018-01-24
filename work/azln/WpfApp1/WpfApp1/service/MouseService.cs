using System.Runtime.InteropServices;
using System.Threading;
using System.Windows.Forms;

class MouseService
{
    [DllImport("USER32.dll", CallingConvention = CallingConvention.StdCall)]
    static extern void SetCursorPos(int X, int Y);

    [DllImport("USER32.dll", CallingConvention = CallingConvention.StdCall)]
    static extern void mouse_event(int dwFlags, int dx, int dy, int cButtons, int dwExtraInfo);

    private const int MOUSEEVENTF_LEFTDOWN = 0x2;
    private const int MOUSEEVENTF_LEFTUP = 0x4;

    /// <summary>
    /// 指定座標を左クリックします.
    /// </summary>
    /// <param name="x"></param>
    /// <param name="y"></param>
    public void ClickLeft(int x, int y)
    {
        System.Random r = new System.Random();
        x += r.Next(30);
        y += r.Next(20);

        SetCursorPos(x, y);
        mouse_event(MOUSEEVENTF_LEFTDOWN, 0, 0, 0, 0);
        mouse_event(MOUSEEVENTF_LEFTUP, 0, 0, 0, 0);
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
}
