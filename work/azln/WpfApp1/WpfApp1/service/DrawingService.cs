using System;
using System.Drawing;
using System.Runtime.InteropServices;
using System.Windows.Forms;

class DrawingService
{
    [DllImport("User32.dll")]
    static extern IntPtr GetDC(IntPtr hwnd);

    [DllImport("User32.dll")]
    static extern void ReleaseDC(IntPtr hwnd, IntPtr dc);

    public static void DrawLines(ref bool breakFlg, ref int width, ref int height)
    {
        breakFlg = false;

        IntPtr desktopDC = GetDC(IntPtr.Zero);
        Graphics g = Graphics.FromHdc(desktopDC);

        Point p1 = new Point();
        Point p2 = new Point();
        Point p3 = new Point();
        Point p4 = new Point();

        // 線フォーマット
        Pen pen = new Pen(Brushes.Red);

        while (!breakFlg)
        {
            // 四角形を描画するための座標
            p1.X = Cursor.Position.X;
            p1.Y = Cursor.Position.Y;
            p2.X = p1.X - width;
            p2.Y = p1.Y;
            p3.X = p1.X - width;
            p3.Y = p1.Y - height;
            p4.X = p1.X;
            p4.Y = p1.Y - height;

            // 取得対象領域の枠として描画するため
            p1.X += 1;
            p1.Y += 1;
            p2.X -= 1;
            p2.Y += 1;
            p3.X -= 1;
            p3.Y -= 1;
            p4.X += 1;
            p4.Y -= 1;

            // 描画
            g.DrawLines(pen, new Point[] {p1, p2, p3, p4, p1});

            // メッセージポンプ（フリーズ回避）
            Application.DoEvents();
        }
        g.Dispose();
        ReleaseDC(IntPtr.Zero, desktopDC);
    }
}