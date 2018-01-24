using System.Collections.Generic;
using System.Drawing;

namespace Dto
{
    class ClickPointDto
    {
        public string Name { get; set; }
        public List<uint[]> ColorsList { get; set; }
        public int Width { get; set; }
        public int Height { get; set; }
        public Point[] Points { get; set; }

        public static ClickPointDto GetMapSelectPage()
        {
            ClickPointDto dto = new ClickPointDto();
            dto.Name = "mapSelectPage";
            dto.ColorsList = new List<uint[]> {
                new uint[] {
                    0xff141415, 0xff262628, 0xff515155, 0xff75757c, 0xff8f8f97, 0xff909098, 0xff898990, 0xff82828a, 0xff87878f, 0xff86868e, 0xff7b7b82, 0xff58585d, 0xff323235, 0xff121214, 0xff080809, 0xff1e1e20, 0xff424246, 0xff6c6c72, 0xff818188, 0xff8a8a91,
                    0xff262628, 0xff525257, 0xff93939b, 0xffa8a8b2, 0xffa6a6b0, 0xff86868e, 0xff707076, 0xff65656a, 0xff727278, 0xff85858d, 0xff92929a, 0xff84848c, 0xff5a5a5f, 0xff313134, 0xff252527, 0xff4a4a4e, 0xff7c7c83, 0xffa0a0a9, 0xff9999a2, 0xff83838b,
                    0xff37373a, 0xff7a7a81, 0xffc8c8d4, 0xffc7c7d2, 0xffa2a2ab, 0xff636368, 0xff3f3f43, 0xff303032, 0xff3e3e42, 0xff5f5f64, 0xff7f7f86, 0xff8b8b94, 0xff6a6a71, 0xff454549, 0xff424245, 0xff75757b, 0xffaeaeb7, 0xffbfbfca, 0xff9898a0, 0xff616167,
                    0xff404044, 0xff898991, 0xffd9d9e5, 0xffc5c5d1, 0xff8a8a92, 0xff3e3e41, 0xff1a1a1b, 0xff0b0b0b, 0xff111112, 0xff232325, 0xff363639, 0xff434347, 0xff363639, 0xff2c2c2f, 0xff49494d, 0xff898991, 0xffc2c2ce, 0xffc1c1cc, 0xff888890, 0xff434347,
                    0xff3f3f42, 0xff828289, 0xffd2d2de, 0xffc5c5d0, 0xff909098, 0xff404043, 0xff161617, 0xff010101, 0xff030303, 0xff0a0a0a, 0xff121213, 0xff18181a, 0xff141415, 0xff181819, 0xff3c3c3f, 0xff808088, 0xffbfbfca, 0xffc8c8d4, 0xff8f8f97, 0xff454549,
                    0xff38383b, 0xff6e6e74, 0xffbdbdc9, 0xffc4c4d0, 0xffa3a3ad, 0xff57575c, 0xff252527, 0xff050505, 0xff020202, 0xff060606, 0xff0d0d0e, 0xff151517, 0xff181819, 0xff1e1e1f, 0xff333336, 0xff6d6d74, 0xffaaaab4, 0xffcbcbd7, 0xff9e9ea7, 0xff59595e,
                    0xff29292c, 0xff4a4a4f, 0xff9898a1, 0xffbebeca, 0xffc2c2ce, 0xff86868e, 0xff49494d, 0xff171719, 0xff09090a, 0xff1d1d1f, 0xff3f3f43, 0xff6a6a71, 0xff76767d, 0xff6e6e75, 0xff4d4d51, 0xff59595e, 0xff7e7e85, 0xffbbbbc6, 0xffb1b1bb, 0xff86868e,
                    0xff37373b, 0xff323235, 0xff606066, 0xff8b8b93, 0xffa6a6b0, 0xff96969f, 0xff7a7a81, 0xff616167, 0xff5b5b60, 0xff6a6a70, 0xff828289, 0xff9b9ba5, 0xff92929a, 0xff75757b, 0xff3f3f43, 0xff36363a, 0xff49494d, 0xff7f7f86, 0xff91919a, 0xff8f8f98,
                    0xff3d3d41, 0xff1d1d1f, 0xff2a2a2c, 0xff4a4a4f, 0xff6d6d73, 0xff808087, 0xff87878f, 0xff8a8a92, 0xff8d8d96, 0xff93939c, 0xff9898a1, 0xff9898a1, 0xff7d7d84, 0xff55555a, 0xff242427, 0xff151516, 0xff1a1a1b, 0xff3b3b3f, 0xff5b5b61, 0xff75757c,
                    0xff0c0c0d, 0xff060606, 0xff080809, 0xff0f0f10, 0xff161617, 0xff1a1a1b, 0xff1b1b1d, 0xff1c1c1e, 0xff1d1d1e, 0xff1e1e1f, 0xff1f1f21, 0xff1f1f21, 0xff19191b, 0xff111112, 0xff070708, 0xff040404, 0xff050506, 0xff0c0c0d, 0xff121213, 0xff181819
                }
            };
            dto.Width = 20;
            return dto;
        }
        public static ClickPointDto GetShutsugeki()
        {
            ClickPointDto shutugeki = new ClickPointDto();
            shutugeki.Name = "shutugeki";
            shutugeki.ColorsList = new List<uint[]> {
                new uint[] {
                    0xfff4cc5e, 0xfff4cc5e, 0xfff4cc5e, 0xfff4cc5e, 0xfff4cc5e
                }
            };
            shutugeki.Width = 5;
            return shutugeki;
        }
        public static ClickPointDto GetKantaiSentaku()
        {
            ClickPointDto kantaiSentaku = new ClickPointDto();
            kantaiSentaku.Name = "kantaiSentaku";
            kantaiSentaku.ColorsList = new List<uint[]> {
                new uint[] {
                    0xffffffff, 0xffffffff, 0xffffffff, 0xffffffff, 0xffffffff,
                    0xffe3ddca, 0xffe4ddca, 0xffe4ddca, 0xfffaf8f3, 0xffffffff,
                    0xffe3ddca, 0xffe4ddca, 0xffe4ddca, 0xfffaf8f4, 0xffffffff,
                    0xffffffff, 0xffede8d9, 0xffe4ddca, 0xfffaf8f4, 0xffffffff
                }
            };
            kantaiSentaku.Width = 5;
            return kantaiSentaku;
        }
        public static ClickPointDto GetEnemy1_1()
        {
            ClickPointDto enemy1_1 = new ClickPointDto();
            enemy1_1.Name = "enemy1_1";
            enemy1_1.ColorsList = new List<uint[]> {
                new uint[] { 0xffd4c416, 0xffd4c416 },
                new uint[] { 0xffcdbc12, 0xffccbb11 },
                new uint[] { 0xffccbb11, 0xffccbb11 },
                new uint[] { 0xffccbb10, 0xffccbb10 }
            };
            enemy1_1.Width = 2;
            return enemy1_1;
        }
        public static ClickPointDto GetEnemy2_1()
        {
            ClickPointDto enemy2_1 = new ClickPointDto();
            enemy2_1.Name = "enemy2_1";
            enemy2_1.ColorsList = new List<uint[]> {
                new uint[] {
                    0xffddaa00, 0xffddaa00,
                    0xffddaa00, 0xffddaa00
                }
            };
            enemy2_1.Width = 2;
            return enemy2_1;
        }
        public static ClickPointDto GetEnemy3_1()
        {
            ClickPointDto enemy3_1 = new ClickPointDto();
            enemy3_1.Name = "enemy3_1";
            enemy3_1.ColorsList = new List<uint[]> {
                new uint[] {
                    0xffbb3300,
                    0xffbb3300,
                    0xffbb3300,
                    0xffbb3300
                }
            };
            enemy3_1.Width = 1;
            return enemy3_1;
        }
        public static ClickPointDto GetEnemyBoss()
        {
            ClickPointDto enemyBoss = new ClickPointDto();
            enemyBoss.Name = "enemyBoss";
            enemyBoss.ColorsList = new List<uint[]> {
                new uint[] {
                    0xfffb4c51, 0xfffb4c51,
                    0xfffb4c51, 0xfffb4c51
                }
            };
            enemyBoss.Width = 2;
            return enemyBoss;
        }
        public static ClickPointDto GetMsgIdoFuka()
        {
            ClickPointDto msgIdoFuka = new ClickPointDto();
            msgIdoFuka.Name = "msgIdoFuka";
            msgIdoFuka.ColorsList = new List<uint[]> {
                new uint[] {
                    0xffdf830c, 0xffdf830c,
                    0xffdf830c, 0xffdf830c
                }
            };
            msgIdoFuka.Width = 2;
            return msgIdoFuka;
        }
        public static ClickPointDto GetKaihi()
        {
            ClickPointDto kaihi = new ClickPointDto();
            kaihi.Name = "kaihi";
            kaihi.ColorsList = new List<uint[]> {
                new uint[] {
                    0xffb7b7af, 0xffb7b7af,
                    0xffb7b7af, 0xffb7b7af
                }
            };
            kaihi.Width = 2;
            return kaihi;
        }
        public static ClickPointDto GetButtleStart()
        {
            ClickPointDto buttleStart = new ClickPointDto();
            buttleStart.Name = "buttleStart";
            buttleStart.ColorsList = new List<uint[]> {
                new uint[] {
                    0xff7962b2, 0xff7962b2, 0xff7962b2,
                    0xff7962b2, 0xff7962b2, 0xff7962b2
                },
                new uint[] {
                    0xff745eab, 0xff745eab, 0xff745eab,
                    0xff745eab, 0xff745eab, 0xff745eab
                }
            };
            buttleStart.Width = 3;
            return buttleStart;
        }
        public static ClickPointDto GetJudgeWinS()
        {
            ClickPointDto judgeWinS = new ClickPointDto();
            judgeWinS.Name = "judgeWinS";
            judgeWinS.ColorsList = new List<uint[]> {
                new uint[] {
                    0xff672818, 0xff672818,
                    0xff672818, 0xff672818,
                    0xff672818, 0xff672818
                }
            };
            judgeWinS.Width = 2;
            return judgeWinS;
        }
        public static ClickPointDto GetJudgeWinA()
        {
            ClickPointDto judgeWinA = new ClickPointDto();
            judgeWinA.Name = "judgeWinA";
            judgeWinA.ColorsList = new List<uint[]> {
                new uint[] {
                    0xffffeb4a, 0xffffeb44, 0xffffed4b, 0xffffef51, 0xfffff161,
                    0xfffff680, 0xfffff368, 0xfffff262, 0xffffeb4b, 0xffffea49,
                    0xfffff99e, 0xffffef5e, 0xffffe744, 0xffffe237, 0xfffee84b,
                    0xfffefaae, 0xffffef65, 0xffffe135, 0xffffe234, 0xfffbe95a
                }
            };
            judgeWinA.Width = 5;
            return judgeWinA;
        }
        public static ClickPointDto GetGetItem()
        {
            ClickPointDto getItem = new ClickPointDto();
            getItem.Name = "getItem";
            getItem.ColorsList = new List<uint[]> {
                new uint[] { 0xff723621, 0xff723621 },
                new uint[] { 0xff733621, 0xff733621 }
            };
            getItem.Width = 2;
            return getItem;
        }
        public static ClickPointDto GetDrop()
        {
            ClickPointDto drop = new ClickPointDto();
            drop.Name = "drop";
            drop.ColorsList = new List<uint[]> {
                new uint[] {
                    0xff777777, 0xff777777, 0xff777777, 0xff777777, 0xff777777,
                    0xff777777, 0xff777777, 0xff777777, 0xff777777, 0xff777777,
                    0xff777777, 0xff777777, 0xff777777, 0xff777777, 0xff777777,
                    0xff777777, 0xff777777, 0xff777777, 0xff777777, 0xff777777
                }
            };
            drop.Width = 5;
            return drop;
        }
        public static ClickPointDto GetKakunin()
        {
            ClickPointDto kakunin = new ClickPointDto();
            kakunin.Name = "kakunin";
            kakunin.ColorsList = new List<uint[]> {
                new uint[] {
                    0xff959595, 0xffeeeeee, 0xfffefefe, 0xfffafafa, 0xffdedede,
                    0xff7b7b7b, 0xffb0b0b0, 0xffe4e4e4, 0xffd6d6d6, 0xffb9b9b9,
                    0xff949494, 0xff737272, 0xff949393, 0xffa5a4a4, 0xff9b9a9a,
                    0xffc0c0c0, 0xff80807f, 0xff7e7d7d, 0xffb2b1b1, 0xffdcdcdb
                }
            };
            kakunin.Width = 5;
            return kakunin;
        }
        public static ClickPointDto GetKinkyuNinmu()
        {
            ClickPointDto kinkyuNinmu = new ClickPointDto();
            kinkyuNinmu.Name = "kinkyuNinmu";
            kinkyuNinmu.ColorsList = new List<uint[]> {
                new uint[] {
                    0xff943a00, 0xff943a00,
                    0xff943a00, 0xff943a00
                }
            };
            kinkyuNinmu.Width = 2;
            return kinkyuNinmu;
        }
    }
}
