   M S B A M L   `   `   `  ����[  WSystem.Windows.Forms, Version=4.0.0.0, Culture=neutral, PublicKeyToken=b77a5c561934e089Y@clr-namespace:System.Windows.Forms;assembly=System.Windows.FormsSystem.Windows.Forms  5      B >WpfApp1, Version=1.0.0.0, Culture=neutral, PublicKeyToken=null!clr-namespace:WpfApp1WpfApp1 5   	      WpfApp1.MainWindow   5   	   \ XPresentationFramework, Version=4.0.0.0, Culture=neutral, PublicKeyToken=31bf3856ad364e35R NWindowsBase, Version=4.0.0.0, Culture=neutral, PublicKeyToken=31bf3856ad364e35^ ZWindowsFormsIntegration, Version=4.0.0.0, Culture=neutral, PublicKeyToken=31bf3856ad364e35W SPresentationCore, Version=4.0.0.0, Culture=neutral, PublicKeyToken=31bf3856ad364e35F 9http://schemas.microsoft.com/winfx/2006/xaml/presentation     5   	   Owf@clr-namespace:System.Windows.Forms;assembly=System.Windows.Forms     5      R NSystem.Xaml, Version=4.0.0.0, Culture=neutral, PublicKeyToken=b77a5c561934e089:x,http://schemas.microsoft.com/winfx/2006/xaml     5   	   @d2http://schemas.microsoft.com/expression/blend/2008     5   	   Jmc;http://schemas.openxmlformats.org/markup-compatibility/2006     5   	   'localclr-namespace:WpfApp1     5   	   -   5          � Title$  
MainWindow��5
   	   $	��500��6   $	��750��6)   .��5      � $	��Top=�6   .+�5      �� $
��Left=�6   .+�5      �� -   5        $	��120��5   *   $��80��66   $��開始��6B   �� 5      -   5        $	��120��5   *   $��80��66   $��停止��6B   5      �� 5   
   $
��Left=�6   $��	120,0,0,0q�60   .+�5      �� -   5        $	��120��5   ,   $��80��68   $��	色取得��6D   �� 5      -   5         ��Name$ txtBreakFlg��5      6+   5      �� 5   
   $
��Left=�6   $��	240,0,0,0q�60   .+�5      �� -   5        $	��120��5   0   $��80��6<   $��ボス優先切替��6H   �� 5      -   5        $ txtBossYusenFlg��5      6/   5      �� 5   
   $
��Left=�6   $��	360,0,0,0q�60   .+�5      �� .��6   対象マップ座標6   �� 5      -   5         ��Name$ 	txtPointX��5      $
��Left=�6)    �� TextWrapping$
 Wrap=�6D   $	��Top=�6X   $�� ��6p   $	��120��6x   �� 5      -	   5        $ 	txtPointY��5      $
��Left=�6)   $
 Wrap=�6D   $	��Top=�6X   $�� ��6p   $	��120��6x   5      �� 5   
   $
��Left=�6   $��	480,0,0,0q�60   .+�5      �� .��6    出撃後マップ位置調整6    �� 5      -
   5        $ txtDragAndDropX��5      $
��Left=�6/   $
 Wrap=�6J   $	��Top=�6^   $�� ��6v   $	��120��6~   �� 5       -   5        $ txtDragAndDropY��5       $
��Left=�6/   $
 Wrap=�6J   $	��Top=�6^   $�� ��6v   $	��120��6~   �� 5!      -   5        $	��120��5!   4   $��80��6@   $��Clear��6L   5"      �� 5#   
   $
��Left=�6   $��	600,0,0,0q�60   .+�5$      �� -   5        $	��120��5$   )   $��80��65   $��Debug��6A   �� 5%      -   5        $	��120��5%   )   $��80��65   $��マクロ実行��6A   5&      7  1System.Windows.Forms.Integration.WindowsFormsHost  5(   
   $��0��6   $��	0,160,0,0q�6+   $
��1080��6>   $
��1920��6L      Child. 5)      %   System.Windows.Forms.PictureBox  -   5        pictureBox1��5)      5*      5+      5,      