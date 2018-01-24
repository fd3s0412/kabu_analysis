using System.Text;
using System.IO;
using System;
using System.Drawing;
using System.Collections.Generic;

class FileService
{
    /// <summary>
    /// テキストファイルを出力します.
    /// </summary>
    /// <param name="fileName"></param>
    /// <param name="outputText"></param>
    public void OutputText(string fileName, string outputText)
    {
        Encoding enc = Encoding.GetEncoding("utf-8");
        using (StreamWriter writer = new StreamWriter(fileName, true, enc))
        {
            writer.WriteLine(outputText);
            writer.Close();
        }
    }

    public void OutputUintArray(string fileName, uint[] uintArray)
    {
        string outputText = "";
        for (int i = 0; i < uintArray.Length; i++)
        {
            if (i % 20 == 0) outputText += "\n";
            outputText += "0x" + uintArray[i].ToString("x8") + ", ";
        }
        OutputText(fileName, outputText);
    }

    public void OutputBitmap(string fileName, Bitmap bmp)
    {
        GraphicsService graphicsService = new GraphicsService();
        uint[] uintArray = graphicsService.ConvertBitmapToUintArray(bmp);
        OutputUintArray(fileName, uintArray);
    }
}
