using System.Windows;
using System.Windows.Forms;
using System.Drawing;
using Dto;
using System.Collections.Generic;
using System.Threading.Tasks;
using System.Threading;
using System;

namespace WpfApp1
{
    /// <summary>
    /// MainWindow.xaml の相互作用ロジック
    /// </summary>
    public partial class MainWindow : Window
    {
        // ■画像系処理
        GraphicsService graphicsService = new GraphicsService();
        // ■ファイル系処理
        FileService fileService = new FileService();
        // ■マウス系処理
        MouseService mouseService = new MouseService();
        // ループ処理を抜ける判定に利用する.
        private bool breakFlg = true;
        // 処理を一時停止するためのフラグ.
        private bool waitFlg = false;
        // ボス優先フラグ.
        private bool bossYusenFlg = true;
        // クリック対象
        private ClickPointDto mapSelectPage = ClickPointDto.GetMapSelectPage();
        private ClickPointDto shutugeki = ClickPointDto.GetShutsugeki();
        private ClickPointDto kantaiSentaku = ClickPointDto.GetKantaiSentaku();
        private ClickPointDto enemy1_1 = ClickPointDto.GetEnemy1_1();
        private ClickPointDto enemy2_1 = ClickPointDto.GetEnemy2_1();
        private ClickPointDto enemy3_1 = ClickPointDto.GetEnemy3_1();
        private ClickPointDto enemyBoss = ClickPointDto.GetEnemyBoss();
        private ClickPointDto msgIdoFuka = ClickPointDto.GetMsgIdoFuka();
        private ClickPointDto kaihi = ClickPointDto.GetKaihi();
        private ClickPointDto buttleStart = ClickPointDto.GetButtleStart();
        private ClickPointDto judgeWinS = ClickPointDto.GetJudgeWinS();
        private ClickPointDto judgeWinA = ClickPointDto.GetJudgeWinA();
        private ClickPointDto getItem = ClickPointDto.GetGetItem();
        private ClickPointDto drop = ClickPointDto.GetDrop();
        private ClickPointDto kakunin = ClickPointDto.GetKakunin();
        private ClickPointDto kinkyuNinmu = ClickPointDto.GetKinkyuNinmu();

        /// <summary>
        /// メイン処理.
        /// </summary>
		public MainWindow()
        {
            InitializeComponent();

            KeyUp += new System.Windows.Input.KeyEventHandler(Event_KeyUp);

            txtBreakFlg.Content = breakFlg ? "停止中" : "実行中";
            txtBossYusenFlg.Content = bossYusenFlg.ToString();


            // 5-1
            txtPointX.Text = "370";
            txtPointY.Text = "550";
            txtDragAndDropX.Text = "0";
            txtDragAndDropY.Text = "50";
            // 5-2
            //txtPointX.Text = "1280";
            //txtPointY.Text = "786";
            //txtDragAndDropX.Text = "0";
            //txtDragAndDropY.Text = "0";
            // B2
            //txtPointX.Text = "1320";
            //txtPointY.Text = "280";
            //txtDragAndDropX.Text = "0";
            //txtDragAndDropY.Text = "350";
            // B4
            //txtPointX.Text = "1090";
            //txtPointY.Text = "570";
            //txtDragAndDropX.Text = "-140";
            //txtDragAndDropY.Text = "180";
        }

        //----------------------------------------------------------------------
        // ■アプリ系処理
        //----------------------------------------------------------------------
        /// <summary>
        /// 戦闘をループします.
        /// </summary>
        private void buttleLoop(PictureBox view)
        {
            List<ClickPointDto> dtoList = new List<ClickPointDto>();
            dtoList.Add(mapSelectPage);
            dtoList.Add(shutugeki);
            dtoList.Add(kantaiSentaku);
            if (bossYusenFlg) dtoList.Add(enemyBoss);
            dtoList.Add(enemy3_1);
            dtoList.Add(enemy2_1);
            dtoList.Add(enemy1_1);
            if (!bossYusenFlg) dtoList.Add(enemyBoss);
            dtoList.Add(kaihi);
            dtoList.Add(buttleStart);
            dtoList.Add(judgeWinS);
            dtoList.Add(judgeWinA);
            dtoList.Add(getItem);
            dtoList.Add(drop);
            dtoList.Add(kakunin);
            dtoList.Add(kinkyuNinmu);

            Bitmap bmp = new Bitmap(Screen.PrimaryScreen.Bounds.Width,
                    Screen.PrimaryScreen.Bounds.Height);
            while (!breakFlg)
            {
                // 前回のbitmapをクリア
                bmp.Dispose();

                Thread.Sleep(500);

                // Bitmapの作成
                bmp = new Bitmap(Screen.PrimaryScreen.Bounds.Width,
                    Screen.PrimaryScreen.Bounds.Height);

                // Graphicsを利用して、bmpに画面キャプチャをコピー
                graphicsService.CopyScreen(bmp);

                // 表示
                //view.Image = bmp;

                // メッセージポンプ（フリーズ回避）
                System.Windows.Forms.Application.DoEvents();

                // メイン処理
                analysis(bmp, dtoList);

                GC.Collect();
            }
        }

        /// <summary>
        /// 画面の解析を行い、それに応じた処理を実施します.
        /// </summary>
        /// <param name="nowBmp"></param>
        private void analysis(Bitmap nowBmp, List<ClickPointDto> dtoList)
        {
            if (waitFlg) return;

            graphicsService.SetPointByBitmap(nowBmp, dtoList.ToArray());

            clickPoints(dtoList);
        }

        /// <summary>
        /// クリック対象リストの座標が取得できているものを対象にクリックを実施します.
        /// </summary>
        /// <param name="dtoList"></param>
        private void clickPoints(List<ClickPointDto> dtoList)
        {
            foreach (ClickPointDto dto in dtoList)
            {
                if (dto.Points.Length > 0)
                {
                    foreach (System.Drawing.Point pt in dto.Points)
                    {
                        waitFlg = true;
                        Task.Run(() =>
                        {
                            Thread.Sleep(5000);
                            waitFlg = false;
                        });

                        mouseService.ClickLeft(pt.X, pt.Y);
                        fileService.OutputText("log.txt", dto.Name);

                        // マップ選択画面
                        if (dto == mapSelectPage)
                        {
                            mouseService.ClickLeft(Int32.Parse(txtPointX.Text), Int32.Parse(txtPointY.Text));
                        }

                        // 出撃後、マップ座標補正
                        if (dto == shutugeki && (!txtDragAndDropX.Text.Equals("0") || !txtDragAndDropY.Text.Equals("0")))
                        {
                            fileService.OutputText("log.txt", "DragAndDropLeft");
                            Thread.Sleep(6000);
                            mouseService.DragAndDropLeft(Int32.Parse(txtDragAndDropX.Text), Int32.Parse(txtDragAndDropY.Text));
                        }

                        // 戦闘マップ出撃中
                        if ((dto == enemy1_1 || dto == enemy2_1 || dto == enemy3_1 || dto == enemyBoss) && isShowMsgIdoFuka())
                        {
                            // 移動不可メッセージが表示されている場合、次のポイントをクリックする
                            continue;
                        }
                        return;
                    }
                }
            }
        }

        /// <summary>
        /// 2秒後に移動不可メッセージが表示されているかどうかを確認します.
        /// </summary>
        /// <returns></returns>
        private bool isShowMsgIdoFuka()
        {
            Thread.Sleep(2000);
            Bitmap bmp = new Bitmap(Screen.PrimaryScreen.Bounds.Width,
                    Screen.PrimaryScreen.Bounds.Height);
            graphicsService.CopyScreen(bmp);
            graphicsService.SetPointByBitmap(bmp, new ClickPointDto[] { msgIdoFuka });
            bmp.Dispose();
            if (msgIdoFuka.Points.Length > 0) return true;
            return false;
        }

        //----------------------------------------------------------------------
        // ■イベント設定
        //----------------------------------------------------------------------
        /// <summary>
        /// 起動時処理.
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void Page_Loaded(object sender, RoutedEventArgs e)
        {
        }

        /// <summary>
        /// 開始ボタン押下時の処理.
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
		private void Kaishi_Click(object sender, RoutedEventArgs e)
        {
            breakFlg = false;
            txtBreakFlg.Content = breakFlg ? "停止中" : "実行中";
            buttleLoop(pictureBox1);
        }

        /// <summary>
        /// 停止ボタン押下時の処理.
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void Teishi_Click(object sender, RoutedEventArgs e)
        {
            breakFlg = true;
            txtBreakFlg.Content = breakFlg ? "停止中" : "実行中";
        }

        /// <summary>
        /// 色取得ボタン押下時の処理.
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void GetColor_Click(object sender, RoutedEventArgs e)
        {
            graphicsService.GetColorBytes(ref breakFlg, 20, 10);
            // TODO: 暫定対応
            txtPointX.Text = System.Windows.Forms.Cursor.Position.X.ToString();
            txtPointY.Text = System.Windows.Forms.Cursor.Position.Y.ToString();
        }

        /// <summary>
        /// キー押下を解除した時の処理.
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void Event_KeyUp(object sender, System.Windows.Input.KeyEventArgs e)
        {
            if (e.Key == System.Windows.Input.Key.LeftCtrl) breakFlg = true;
            txtBreakFlg.Content = breakFlg ? "停止中" : "実行中";
        }

        /// <summary>
        /// ボス優先切替ボタン押下時の処理.
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void BossYusenFlg_Click(object sender, RoutedEventArgs e)
        {
            bossYusenFlg = !bossYusenFlg;
            txtBossYusenFlg.Content = bossYusenFlg.ToString();
        }

        private void DragAndDropClear_Click(object sender, RoutedEventArgs e)
        {
            txtDragAndDropX.Text = "0";
            txtDragAndDropY.Text = "0";
        }

        /// <summary>
        /// Debug用ボタン押下処理.
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void Debug_Click(object sender, RoutedEventArgs e)
        {
            Thread.Sleep(1000);
            mouseService.DragAndDropLeft(Int32.Parse(txtDragAndDropX.Text), Int32.Parse(txtDragAndDropY.Text));
        }

        /// <summary>
        /// Macro_Click処理.
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void Macro_Click(object sender, RoutedEventArgs e)
        {
            int wait = 1000;
            int waitKeyCombination = 300;

            for (int i = 0; i < 2062; i++)
            {
                Thread.Sleep(wait);
                mouseService.ClickRight(746, 112);

                Thread.Sleep(wait);
                mouseService.SendInputKey(mouseService.KEYEVENTF_KEYDOWN, Keys.P);
                mouseService.SendInputKey(mouseService.KEYEVENTF_KEYUP, Keys.P);

                Thread.Sleep(wait);
                mouseService.SendInputKey(mouseService.KEYEVENTF_KEYDOWN, Keys.Return);
                mouseService.SendInputKey(mouseService.KEYEVENTF_KEYUP, Keys.Return);

                Thread.Sleep(3000);
                mouseService.ClickRight(755, 165);

                Thread.Sleep(wait);
                mouseService.ClickLeft(815, 420);

                Thread.Sleep(wait);
                mouseService.SendInputKey(mouseService.KEYEVENTF_KEYDOWN, Keys.LControlKey);
                Thread.Sleep(waitKeyCombination);
                mouseService.SendInputKey(mouseService.KEYEVENTF_KEYDOWN, Keys.V);
                mouseService.SendInputKey(mouseService.KEYEVENTF_KEYUP, Keys.V);
                mouseService.SendInputKey(mouseService.KEYEVENTF_KEYUP, Keys.LControlKey);

                Thread.Sleep(wait);
                mouseService.SendInputKey(mouseService.KEYEVENTF_KEYDOWN, Keys.Return);
                mouseService.SendInputKey(mouseService.KEYEVENTF_KEYUP, Keys.Return);

                Thread.Sleep(wait);
                mouseService.ClickLeft(2110, 5);

                Thread.Sleep(wait);
                mouseService.SendInputKey(mouseService.KEYEVENTF_KEYDOWN, Keys.Down);
                mouseService.SendInputKey(mouseService.KEYEVENTF_KEYUP, Keys.Down);

                Thread.Sleep(wait);
                mouseService.SendInputKey(mouseService.KEYEVENTF_KEYDOWN, Keys.LControlKey);
                Thread.Sleep(waitKeyCombination);
                mouseService.SendInputKey(mouseService.KEYEVENTF_KEYDOWN, Keys.C);
                mouseService.SendInputKey(mouseService.KEYEVENTF_KEYUP, Keys.C);
                mouseService.SendInputKey(mouseService.KEYEVENTF_KEYUP, Keys.LControlKey);
            }
        }
    }
}
