using Dto;
using System;
using System.Collections.Generic;
using System.Drawing;
using System.IO;
using System.Windows.Forms;

/// <summary>
/// 画像系処理.
/// </summary>
class GraphicsService
{
    /// <summary>
    /// 画面キャプチャを取得してbmpに設定します.
    /// </summary>
    /// <param name="bmp"></param>
    public void CopyScreen(Bitmap bmp)
    {
        CopyScreen(bmp, new Point(0, 0));
    }
    public void CopyScreen(Bitmap bmp, Point pt)
    {
        Graphics g = Graphics.FromImage(bmp);
        g.CopyFromScreen(pt, new Point(0, 0), bmp.Size);
        g.Dispose();
    }

    /// <summary>
    /// Bitmapをbyte[]に変換します.
    /// </summary>
    /// <param name="bmp"></param>
    /// <returns></returns>
    public byte[] ConvertBitmapToByteArray(Bitmap bmp)
    {
        // Bitmapをbyte配列に変換
        MemoryStream ms = new MemoryStream();
        bmp.Save(ms, System.Drawing.Imaging.ImageFormat.Bmp);
        byte[] byteBmp = ms.GetBuffer();
        ms.Close();
        
        return byteBmp;
    }

    /// <summary>
    /// Bitmapをuint[]に変換します.
    /// </summary>
    /// <param name="bmp"></param>
    /// <returns></returns>
    public uint[] ConvertBitmapToUintArray(Bitmap bmp)
    {
        byte[] byteArray = ConvertBitmapToByteArray(bmp);
        List<uint> uintList = new List<uint>();
        for (int i = 54; i < byteArray.Length; i += 4)
        {
            uintList.Add(BitConverter.ToUInt32(byteArray, i));
        }
        return uintList.ToArray();
    }

    /// <summary>
    /// マウスの座標に基づき画面の色をbyteで取得してファイルに出力します.
    /// </summary>
    /// <param name="breakFlg"></param>
    /// <param name="width"></param>
    /// <param name="height"></param>
    public void GetColorBytes(ref bool breakFlg, int width, int height)
    {
        // 枠描画
        DrawingService.DrawLines(ref breakFlg, ref width, ref height);

        Bitmap bmp = new Bitmap(width, height);

        Point pt = new Point();
        pt.X = Cursor.Position.X - width;
        pt.Y = Cursor.Position.Y - height;

        // Graphicsを利用して、bmpに画面キャプチャをコピー
        CopyScreen(bmp, pt);

        FileService fileService = new FileService();
        fileService.OutputBitmap("GetColorBytes.txt", bmp);

    }

    /// <summary>
    /// 第一引数のbitmapに、第2引数のDTOの色配列が存在する場合、その座標を設定します.
    /// </summary>
    /// <param name="bmp"></param>
    /// <param name="dtos"></param>
    public void SetPointByBitmap(Bitmap bmp, ClickPointDto[] dtos)
    {
        uint[] uintArrBmp = ConvertBitmapToUintArray(bmp);
        for (int i = 0; i < dtos.Length; i++)
        {
            ClickPointDto dto = dtos[i];
            SetPointByBitmap(uintArrBmp, bmp.Width, bmp.Height, dto);
        }
    }

    public void SetPointByBitmap(uint[] uintArrBmp, int bmpWidth, int bmpHeight, ClickPointDto dto)
    {
        List<Point> pointList = new List<Point>();
        foreach (uint[] uintArrTarget in dto.ColorsList)
        {
            for (int i = 0; i < uintArrBmp.Length; i++)
            {
                int x = i % bmpWidth;
                int y = bmpHeight - i / bmpWidth;

                // 先頭1pixelが検索対象の色と一致している、かつ、
                // 既にマッチ済の座標の近辺ではない、かつ、
                // すべての検索対象カラーがマッチした場合、その座標を保存
                if (uintArrBmp[i] == uintArrTarget[0]
                      && IsNotContainsPoints(pointList, x, y, 180, 100)
                      && IsMatchAllColor(uintArrBmp, bmpWidth, i, uintArrTarget, dto.Width)
                )
                {
                    pointList.Add(new Point(x, y));
                }
            }
        }
        dto.Points = pointList.ToArray();
    }

    /// <summary>
    /// iを起点にして、ClickPointDtoのカラーがunitArrBmpにすべて含まれているかをチェックします.
    /// </summary>
    /// <param name="uintArrBmp"></param>
    /// <param name="bmpWidth"></param>
    /// <param name="i"></param>
    /// <param name="dto"></param>
    /// <returns></returns>
    public bool IsMatchAllColor(uint[] uintArrBmp, int bmpWidth, int i, uint[] uintArrTarget, int width)
    {
        int offsetX = i % bmpWidth;
        int offsetY = i / bmpWidth;
        int ySize = uintArrTarget.Length / width;
        for (int y = 0; y < ySize; y++)
        {
            for (int x = 0; x < width; x++)
            {
                if(uintArrTarget[x + y * width] != uintArrBmp[(offsetX + x) + (offsetY + y) * bmpWidth])
                {
                    return false;
                }
            }
        }
        return true;
    }

    /// <summary>
    /// iが指定座標の範囲内に含まれていなければtrueを返します.
    /// </summary>
    /// <param name="pointList"></param>
    /// <param name="i"></param>
    /// <param name="margin"></param>
    /// <returns></returns>
    public bool IsNotContainsPoints(List<Point> pointList, int x, int y, int marginX, int marginY)
    {
        foreach (Point pt in pointList)
        {
            if (pt.X - marginX / 2 <= x && x <= pt.X + marginX / 2 && pt.Y - marginY / 2 <= y && y <= pt.Y + marginY / 2) return false;
        }
        return true;
    }
}
