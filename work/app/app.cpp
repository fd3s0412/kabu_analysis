#pragma comment(lib,"winmm")
#pragma comment(lib,"Gdi32")
#pragma comment(lib,"user32")

#include <windows.h>
#include <tchar.h>
#include <stdio.h>
#include <time.h>
#include <iostream>
#include <fstream>
#include <vector>
#include <string>
#include <map>
#include <thread>

using namespace std;

//--------------------------------------------------------------------------
// ■UTIL系
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
// ランダムな値を返します。
//--------------------------------------------------------------------------
int randRange(int range_min, int range_max)
{
	int u = (double)rand() / (RAND_MAX + 1) * (range_max - range_min) + range_min;
	return u;
}
//--------------------------------------------------------------------------
// 時間を取得します。
//--------------------------------------------------------------------------
string getTime() {
	time_t timer;
	struct tm *t_st;

	// 現在時刻の取得
	time(&timer);

	// 現在時刻を文字列に変換して表示
	t_st = localtime(&timer);
	char b[4096];
	sprintf(b, "[%04d-%02d-%02d %02d:%02d:%02d]", t_st->tm_year + 1900, t_st->tm_mon + 1, t_st->tm_mday, t_st->tm_hour, t_st->tm_min, t_st->tm_sec);
	string str = b;

	return str;
}
//--------------------------------------------------------------------------
// 文字列を分割します。
//--------------------------------------------------------------------------
vector<string> split(const string &str, char delim){
	vector<string> res;
	size_t current = 0, found;
	while ((found = str.find_first_of(delim, current)) != string::npos){
		res.push_back(string(str, current, found - current));
		current = found + 1;
	}
	res.push_back(string(str, current, str.size() - current));
	return res;
}
//--------------------------------------------------------------------------
// ログを出力します。
//--------------------------------------------------------------------------
void log(string text) {
	text = getTime() + text + string("\n");
	FILE *outputfile;         // 出力ストリーム

	outputfile = fopen("log.txt", "a");  // ファイルを書き込み用にオープン(開く)
	if (outputfile == NULL) {          // オープンに失敗した場合
		//MessageBox(NULL, "ログファイルが開けませんでした", TITLE.c_str(), MB_OK);
		return;                         // 異常終了
	}

	fprintf(outputfile, text.c_str()); // ファイルに書く

	fclose(outputfile);          // ファイルをクローズ(閉じる)
}
//--------------------------------------------------------------------------
// 設定ファイルを読み込みます。
//--------------------------------------------------------------------------
map<string, float> loadSetup() {
	map<string, float> map;
	ifstream ifs("setup.ini");
	string str;
	if (!ifs.fail()) {
		char equal[] = "=";
		while (getline(ifs, str)) {
			char slash[] = "/";
			if (str.at(0) == slash[0]) continue;
			vector<string> textSplit = split(str, equal[0]);
			map.insert(make_pair(textSplit[0], stof(textSplit[1])));
		}
	}
	else {
		log("設定ファイルの読み込みに失敗しました");
	}
	return map;
}
//--------------------------------------------------------------------------
// 最大値を返します。
//--------------------------------------------------------------------------
int maxVal(vector<int> list) {
	int maxVal = 0;
	for (auto itr = list.begin(); itr != list.end(); ++itr) {
		if (*itr > maxVal) maxVal = *itr;
	}
	return maxVal;
}
//--------------------------------------------------------------------------
// ウィンドウズメッセージを処理します。
//--------------------------------------------------------------------------
void pumpMessage()
{
	MSG msg;
	while (PeekMessage(&msg, NULL, 0, 0, PM_REMOVE)){
		TranslateMessage(&msg);
		DispatchMessage(&msg);
	}
}
//--------------------------------------------------------------------------
// ■キーボード系
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
// キーを押下します。
//--------------------------------------------------------------------------
void KeyAction(WORD VirtualKey, BOOL bKeepPressing)
{
	INPUT input[1];
	input[0].type = INPUT_KEYBOARD;
	input[0].ki.wVk = VirtualKey;
	input[0].ki.wScan = MapVirtualKey(input[0].ki.wVk, 0);
	input[0].ki.dwFlags = KEYEVENTF_EXTENDEDKEY;
	input[0].ki.time = 0;
	input[0].ki.dwExtraInfo = ::GetMessageExtraInfo();
	::SendInput(1, input, sizeof(INPUT));
	if (!bKeepPressing)
	{
		input[0].ki.dwFlags = KEYEVENTF_EXTENDEDKEY | KEYEVENTF_KEYUP;
		::SendInput(1, input, sizeof(INPUT));
	}
}
//--------------------------------------------------------------------------
// ■マウス系
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
// マウスをクリックします。
//--------------------------------------------------------------------------
void MouseClickAction(){
	// マウス操作実行用のデータ
	INPUT inp[2];

	// マウスの左ボタンを押す
	inp[0].type = INPUT_MOUSE;
	inp[0].mi.dwFlags = MOUSEEVENTF_LEFTDOWN;
	inp[0].mi.dx = 0;
	inp[0].mi.dy = 0;
	inp[0].mi.mouseData = 0;
	inp[0].mi.dwExtraInfo = 0;
	inp[0].mi.time = 0;

	// (3)マウスの左ボタンを離す
	inp[1].type = INPUT_MOUSE;
	inp[1].mi.dwFlags = MOUSEEVENTF_LEFTUP;
	inp[1].mi.dx = 0;
	inp[1].mi.dy = 0;
	inp[1].mi.mouseData = 0;
	inp[1].mi.dwExtraInfo = 0;
	inp[1].mi.time = 0;

	// マウス操作実行
	::SendInput(2, inp, sizeof(INPUT));
}
//--------------------------------------------------------------------------
// マウスをクリックします。
//--------------------------------------------------------------------------
void MouseRightClickAction(){
	// マウス操作実行用のデータ
	INPUT inp[2];

	// マウスの左ボタンを押す
	inp[0].type = INPUT_MOUSE;
	inp[0].mi.dwFlags = MOUSEEVENTF_RIGHTDOWN;
	inp[0].mi.dx = 0;
	inp[0].mi.dy = 0;
	inp[0].mi.mouseData = 0;
	inp[0].mi.dwExtraInfo = 0;
	inp[0].mi.time = 0;

	// (3)マウスの左ボタンを離す
	inp[1].type = INPUT_MOUSE;
	inp[1].mi.dwFlags = MOUSEEVENTF_RIGHTUP;
	inp[1].mi.dx = 0;
	inp[1].mi.dy = 0;
	inp[1].mi.mouseData = 0;
	inp[1].mi.dwExtraInfo = 0;
	inp[1].mi.time = 0;

	// マウス操作実行
	::SendInput(2, inp, sizeof(INPUT));
}
//--------------------------------------------------------------------------
// マウスの左ボタンを押し続けます。
//--------------------------------------------------------------------------
void MouseClickDownAction(){
	// マウス操作実行用のデータ
	INPUT inp[1];

	// マウスの左ボタンを押す
	inp[0].type = INPUT_MOUSE;
	inp[0].mi.dwFlags = MOUSEEVENTF_LEFTDOWN;
	inp[0].mi.dx = 0;
	inp[0].mi.dy = 0;
	inp[0].mi.mouseData = 0;
	inp[0].mi.dwExtraInfo = 0;
	inp[0].mi.time = 0;

	// マウス操作実行
	::SendInput(1, inp, sizeof(INPUT));
}
//--------------------------------------------------------------------------
// マウスの左ボタンを離します。
//--------------------------------------------------------------------------
void MouseClickUpAction(){
	// マウス操作実行用のデータ
	INPUT inp[1];

	// (3)マウスの左ボタンを離す
	inp[0].type = INPUT_MOUSE;
	inp[0].mi.dwFlags = MOUSEEVENTF_LEFTUP;
	inp[0].mi.dx = 0;
	inp[0].mi.dy = 0;
	inp[0].mi.mouseData = 0;
	inp[0].mi.dwExtraInfo = 0;
	inp[0].mi.time = 0;

	// マウス操作実行
	::SendInput(1, inp, sizeof(INPUT));
}
//--------------------------------------------------------------------------
// マウスを移動させます。
//--------------------------------------------------------------------------
void MouseMoveAction(int mouseX, int mouseY){
	// マウス操作実行用のデータ
	INPUT inp[1];

	// (1)マウスカーソルを移動する(スクリーン座標)
	inp[0].type = INPUT_MOUSE;
	inp[0].mi.dwFlags = MOUSEEVENTF_MOVE | MOUSEEVENTF_ABSOLUTE;
	inp[0].mi.dx = mouseX * (65535 / GetSystemMetrics(SM_CXSCREEN));
	inp[0].mi.dy = mouseY * (65535 / GetSystemMetrics(SM_CYSCREEN));
	inp[0].mi.mouseData = 0;
	inp[0].mi.dwExtraInfo = 0;
	inp[0].mi.time = 0;

	// マウス操作実行
	::SendInput(1, inp, sizeof(INPUT));
}
//--------------------------------------------------------------------------
// マウスを移動させます。（ブレ追加）
//--------------------------------------------------------------------------
void MouseMoveActionWithRand(int x, int y, int randZahyo) {
	x = x + randRange(0, randZahyo);
	y = y + randRange(0, randZahyo);

	// クリック
	MouseMoveAction(x, y);
}
//--------------------------------------------------------------------------
// ■色系
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
// 座標の色を取得します。
//--------------------------------------------------------------------------
bool outputLog = false;
COLORREF getClr(int x, int y) {
	HWND hWnd = GetDesktopWindow();
	HDC hdc = GetWindowDC(hWnd);
	COLORREF clr = GetPixel(hdc, x, y);
	ReleaseDC(hWnd, hdc);

	if (outputLog) {
		char b[4096];
		sprintf(b, "座標(%d, %d), 色:(%d,%d,%d)", x, y, GetRValue(clr), GetGValue(clr), GetBValue(clr));
		string m = b;
		log(m);
	}

	return clr;
}
//--------------------------------------------------------------------------
// 座標の色を取得します。
//--------------------------------------------------------------------------
int getClrSum(int x, int y) {
	HWND hWnd = GetDesktopWindow();
	HDC hdc = GetWindowDC(hWnd);
	COLORREF clr = GetPixel(hdc, x, y);
	ReleaseDC(hWnd, hdc);
	int sum = GetRValue(clr) + GetGValue(clr) + GetBValue(clr);
	return sum;
}
//--------------------------------------------------------------------------
// 座標の色を設定します。
//--------------------------------------------------------------------------
void setClr(int x, int y, COLORREF clr) {
	HWND hWnd = GetDesktopWindow();
	HDC hdc = GetWindowDC(hWnd);
	SetPixel(hdc, x, y, clr);
	ReleaseDC(hWnd, hdc);
}
//--------------------------------------------------------------------------
// ■音系
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
// WAVEファイルをメモリに読み込みます
// ＜使い方＞
// LPCSTR wavTargetSleep = getWaveFile("voice_taiha.wav");
// PlaySound(wavTargetSleep, NULL, SND_MEMORY | SND_ASYNC);
//--------------------------------------------------------------------------
LPCSTR getWaveFile(LPCTSTR lpFileName) {
	LPCSTR lpSound;
	HANDLE fh = CreateFile(lpFileName, GENERIC_READ, 0, NULL, OPEN_EXISTING, FILE_ATTRIBUTE_NORMAL, NULL);
	if (fh == INVALID_HANDLE_VALUE){
		MessageBox(NULL, "WAVEファイルが開けません", lpFileName, MB_OK);
		return NULL;
	}
	DWORD dwFileSize = GetFileSize(fh, NULL);
	lpSound = (LPCSTR)HeapAlloc(GetProcessHeap(), HEAP_ZERO_MEMORY, dwFileSize);
	DWORD dwReadSize;
	ReadFile(fh, (LPVOID)lpSound, dwFileSize, &dwReadSize, NULL);
	CloseHandle(fh);
	return lpSound;
}
//--------------------------------------------------------------------------
// ■チェック系
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
// コントロールキーが押されているかを判定します。
//--------------------------------------------------------------------------
bool checkKeyCONTROL() {
	if (GetKeyState(VK_CONTROL) < 0){
		// MessageBox(NULL, "コントロールキーが押されました。", "checkKeyCONTROL", MB_OK);
		return true;
	}
	else {
		return false;
	}
}
//--------------------------------------------------------------------------
// スリープ中にコントロールキーが押された場合、真を返します
//--------------------------------------------------------------------------
bool sleepWithCheck(int sleepTime) {
	// ループ回数計算
	int loopTime = 50;
	int cnt = sleepTime / loopTime;

	for (int i = 0; i < cnt; i++) {
		Sleep(loopTime);
		if (checkKeyCONTROL()) {
			return true;
		}

		pumpMessage();
	}
	return false;
}
//--------------------------------------------------------------------------
// clrが指定色（wornClrMargin）の範囲内かどうかを判定します。
//--------------------------------------------------------------------------
int checkClr(COLORREF clr, float warnClrR, float warnClrG, float warnClrB, float warnClrMargin) {
	if (GetRValue(clr) >= warnClrR - warnClrMargin && GetGValue(clr) >= warnClrG - warnClrMargin && GetBValue(clr) >= warnClrB - warnClrMargin) {
		if (GetRValue(clr) <= warnClrR + warnClrMargin && GetGValue(clr) <= warnClrG + warnClrMargin && GetBValue(clr) <= warnClrB + warnClrMargin) {
			return 1;
		}
	}
	return 0;
}
int checkClr(float x, float y, float warnClrR, float warnClrG, float warnClrB, float warnClrMargin) {
	COLORREF clr = getClr(x, y);
	return checkClr(clr, warnClrR, warnClrG, warnClrB, warnClrMargin);
}
//--------------------------------------------------------------------------
// ■各種処理
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
// 一定間隔ごとにキーを押下します。
//--------------------------------------------------------------------------
void keyPressRoop(WORD key, int waitTime) {
	string funcName = "keyPressRoop";
	MessageBox(NULL, "起動します。", funcName.c_str(), MB_OK);
	while (true) {
		if (sleepWithCheck(waitTime)) break;
		KeyAction(key, FALSE);
	}

	// MessageBox(NULL, "終了します。", funcName.c_str(), MB_OK);
}
//--------------------------------------------------------------------------
// 指定座標の色が変わったらクリックします。
//--------------------------------------------------------------------------
void clickTargetPointWhenChangeColor() {
	string funcName = "clickTargetPointWhenChangeColor";
	//MessageBox(NULL, "起動します。", funcName.c_str(), MB_OK);
	COLORREF clr = NULL;
	COLORREF clrTmp = NULL;
	POINT pt;
	// 座標を設定（キーが押されたときのマウスの座標）
	while (true) {
		if (GetKeyState('1') < 0) {
			GetCursorPos(&pt);
			clr = getClr(pt.x, pt.y);
			break;
		}
		if (sleepWithCheck(100)) break;
	}
	// 色が変わるまで待機
	while (true) {
		if (GetKeyState('2') < 0) {
			while (true) {
				clrTmp = getClr(pt.x, pt.y);
				if (GetRValue(clr) != GetRValue(clrTmp)) {
					MouseClickAction();
					log("Click");
					break;
				}
				if (GetKeyState(VK_CONTROL) < 0) break;
			}
		}
		if (sleepWithCheck(100)) break;
	}	
}
//--------------------------------------------------------------------------
// 釣り
// 1:起点となる位置にマウスを置き、[1]を押す。
// 2:起点から10pixcel縦横すべての色を取得して合計。
// 3:指定数値以上色の合計が変動した場合に特定のキーを押す。
//--------------------------------------------------------------------------
void tsuri(HWND hWnd) {
	HDC hdc = GetDC(hWnd);
	HWND hWndDesktop = GetDesktopWindow();
	HDC hdcDesktop = GetWindowDC(hWndDesktop);
	string funcName = "tsuri";
	//MessageBox(NULL, "起動します。", funcName.c_str(), MB_OK);
	COLORREF clrTmp = NULL;
	COLORREF clrForSet = RGB(255, 0, 0);
	POINT pt;
	int hitCount = 0;
	// 座標を設定（キーが押されたときのマウスの座標）
	while (true) {
		if (GetKeyState('1') < 0) {
			GetCursorPos(&pt);
			break;
		}
		GetCursorPos(&pt);
		for (int i = 0; i < 40; i++) {
			setClr(pt.x + i, pt.y - 1, clrForSet);
		}
		for (int i = 0; i < 40; i++) {
			setClr(pt.x + i, pt.y + 30, clrForSet);
		}
		for (int i = 0; i < 30; i++) {
			setClr(pt.x - 1, pt.y + i, clrForSet);
		}
		for (int i = 0; i < 30; i++) {
			setClr(pt.x + 40, pt.y + i, clrForSet);
		}
		if (sleepWithCheck(50)) break;
	}
	// 色が変わるまで待機
	while (true) {
		if (GetKeyState('2') < 0) {
			bool renzokuFlg = TRUE;
			while (true) {
				for (int i = 0; i < 40; i++) {
					setClr(pt.x + i, pt.y - 1, clrForSet);
				}
				for (int i = 0; i < 40; i++) {
					setClr(pt.x + i, pt.y + 30, clrForSet);
				}
				for (int i = 0; i < 30; i++) {
					setClr(pt.x - 1, pt.y + i, clrForSet);
				}
				for (int i = 0; i < 30; i++) {
					setClr(pt.x + 40, pt.y + i, clrForSet);
				}

				if (GetKeyState(VK_END) < 0) break;
				//InvalidateRect(hWnd, NULL, TRUE);
				bool hitFlg = TRUE;

				// 色の記録
				InvalidateRect(hWnd, NULL, TRUE);
				for (int y = 0; y < 10; y++) {
					for (int x = 0; x < 11; x++) {
						clrTmp = GetPixel(hdcDesktop, pt.x + (x * 3), pt.y + (y * 3));
						char b[32];
						sprintf(b, "(%d, %d, %d)", GetRValue(clrTmp), GetGValue(clrTmp), GetBValue(clrTmp));
						string m = b;
						TextOut(hdc, (200 + x * 100), (y * 20), m.c_str(), 18);
						if (GetRValue(clrTmp) >= 180 && GetGValue(clrTmp) >= 180) {
							hitFlg = FALSE;
							// 一度釣り開始状態にしてからでないと釣りあげられないようにする。
							renzokuFlg = FALSE;
							break;
						}
					}
					if (hitFlg == FALSE && renzokuFlg == FALSE) break;
				}

				// 色変動判定
				if (hitFlg && !renzokuFlg) {
					KeyAction('6', FALSE);
					hitCount++;
					renzokuFlg = TRUE;

					char b[32];
					sprintf(b, "Hit Count: %d", hitCount);
					string m = b;
					TextOut(hdc, 200, 240, m.c_str(), 32);

					if (sleepWithCheck(12000)) break;
				}
				if (sleepWithCheck(50)) break;
			}
		}

		if (sleepWithCheck(500)) break;
	}
	Sleep(300);
	ReleaseDC(hWnd, hdc);
	ReleaseDC(hWndDesktop, hdcDesktop);
}
void tsuri2(HWND hWnd) {
	HWND desktop = GetDesktopWindow();
	HDC hdc = GetDC(hWnd);
	HDC hdcDesktop = GetDC(desktop);

	//スクリーンの情報を得る
	// RECT rc;
	// int width, height;
	// GetWindowRect(desktop, &rc);
	// width = rc.right;
	// height = rc.bottom;
	int width = 40;
	int height = 30;

	// 座標を設定（キーが押されたときのマウスの座標）
	COLORREF clrForSet = RGB(255, 0, 0);
	POINT pt;
	int hitCount = 0;
	while (true) {
		if (GetKeyState('1') < 0) {
			GetCursorPos(&pt);
			break;
		}
		GetCursorPos(&pt);
		for (int i = 0; i <= width + 1; i++) {
			setClr(pt.x - width - 1 + i, pt.y - height - 1, clrForSet);
			setClr(pt.x - width - 1 + i, pt.y + 1, clrForSet);
		}
		for (int i = 0; i <= height + 1; i++) {
			setClr(pt.x - width - 1, pt.y - height - 1 + i, clrForSet);
			setClr(pt.x + 1, pt.y - height - 1 + i, clrForSet);
		}
		if (sleepWithCheck(50)) break;
	}
	// 座標0, 0を含むため、+1している。
	int sX = pt.x - width + 1;
	int sY = pt.y - height + 1;

	//DIBの情報を設定する
	BITMAPINFO bmpInfo;
	bmpInfo.bmiHeader.biSize = sizeof(BITMAPINFOHEADER);
	bmpInfo.bmiHeader.biWidth = width;
	bmpInfo.bmiHeader.biHeight = height;
	bmpInfo.bmiHeader.biPlanes = 1;
	bmpInfo.bmiHeader.biBitCount = 32;
	bmpInfo.bmiHeader.biCompression = BI_RGB;

	//DIBSection作成
	LPDWORD lpPixel;
	HBITMAP hBitmap = CreateDIBSection(hdc, &bmpInfo, DIB_RGB_COLORS, (void**)&lpPixel, NULL, 0);
	HDC hMemDC = CreateCompatibleDC(hdc);
	SelectObject(hMemDC, hBitmap);

	//表画面へ転送
	InvalidateRect(hWnd, NULL, TRUE);
	PAINTSTRUCT ps;
	hdc = BeginPaint(hWnd, &ps);
	bool renzokuFlg = TRUE;
	while (true) {
		for (int i = 0; i <= width + 1; i++) {
			setClr(pt.x - width - 1 + i, pt.y - height - 1, clrForSet);
			setClr(pt.x - width - 1 + i, pt.y + 1, clrForSet);
		}
		for (int i = 0; i <= height + 1; i++) {
			setClr(pt.x - width - 1, pt.y - height - 1 + i, clrForSet);
			setClr(pt.x + 1, pt.y - height - 1 + i, clrForSet);
		}

		//スクリーンをDIBSectionにコピー
		BitBlt(hMemDC, 0, 0, width, height, hdcDesktop, sX, sY, SRCCOPY);
		BitBlt(hdc, 200, 0, width, height, hMemDC, 0, 0, SRCCOPY);

		// 色の記録
		bool hitFlg = TRUE;
		for (int y = 0; y < height; y++) {
			for (int x = 0; x < width; x++) {
				
				char b[32];
				sprintf(b, "(%02x, %02x, %02x)", ((lpPixel[x + y * width] >> 16) & 0xff), ((lpPixel[x + y * width] >> 8) & 0xff), (lpPixel[x + y * width] & 0xff));
				string m = b;
				TextOut(hdc, (200 + width + x * 100), ((height * 20) - (y * 20)), m.c_str(), 32);

				if (((lpPixel[x + y * width] >> 16) & 0xff) >= 0xB4 && ((lpPixel[x + y * width] >> 8) & 0xff) >= 0xB4) {
 					hitFlg = FALSE;
 					// 一度釣り開始状態にしてからでないと釣りあげられないようにする。
 					renzokuFlg = FALSE;
					break;
 				}
			}
			if (hitFlg == FALSE && renzokuFlg == FALSE) break;
		}

		// 色変動判定
		if (hitFlg && !renzokuFlg) {
			KeyAction('6', FALSE);
			hitCount++;
			renzokuFlg = TRUE;

			char b[32];
			sprintf(b, "Hit Count: %d", hitCount);
			string m = b;
			TextOut(hdc, 200 + width, 0, m.c_str(), 32);

			if (sleepWithCheck(12000)) break;
		}

		pumpMessage();
		if (GetKeyState(VK_CONTROL) < 0) break;
	}
	EndPaint(hWnd, &ps);

	ReleaseDC(hWnd, hdc);
	ReleaseDC(desktop, hdcDesktop);
	//自らlpPixelを解放するべからず
	DeleteDC(hMemDC);
	DeleteObject(hBitmap);  //BMPを削除した時、lpPixelも自動的に解放される
}
//--------------------------------------------------------------------------
// ■ウィンドウ系
//--------------------------------------------------------------------------
//プロトタイプ宣言
LRESULT  CALLBACK   WndProc(HWND, UINT, WPARAM, LPARAM);
int      WINAPI     WinMain(HINSTANCE, HINSTANCE, LPSTR, int);
// ID
#define BUTTON_ID1 1
#define BUTTON_ID2 2
#define BUTTON_ID3 3
//Windws イベント用関数
LRESULT  CALLBACK  WndProc(HWND hWnd, UINT msg, WPARAM wParam, LPARAM lParam){
	static HWND btnKeyPressRoop;
	static HWND btnClickTargetPointWhenChangeColor;
	static HWND btnTsuri;

	//渡された message から、イベントの種類を解析する
	switch (msg){
		case WM_CREATE:
			// ボタン配置
			btnKeyPressRoop = CreateWindow(
				TEXT("BUTTON"), TEXT("keyPressRoop"),
				WS_CHILD | WS_VISIBLE | BS_PUSHBUTTON,
				0, 0, 200, 40,
				hWnd, (HMENU)BUTTON_ID1, ((LPCREATESTRUCT)(lParam))->hInstance, NULL
				);
			// ボタン配置
			btnClickTargetPointWhenChangeColor = CreateWindow(
				TEXT("BUTTON"), TEXT("clickPoint"),
				WS_CHILD | WS_VISIBLE | BS_PUSHBUTTON,
				0, 40, 200, 40,
				hWnd, (HMENU)BUTTON_ID2, ((LPCREATESTRUCT)(lParam))->hInstance, NULL
				);
			// ボタン配置
			btnTsuri = CreateWindow(
				TEXT("BUTTON"), TEXT("釣り"),
				WS_CHILD | WS_VISIBLE | BS_PUSHBUTTON,
				0, 80, 200, 40,
				hWnd, (HMENU)BUTTON_ID3, ((LPCREATESTRUCT)(lParam))->hInstance, NULL
				);
			break;

		// 終了
		case WM_DESTROY:
			PostQuitMessage(0);
			return 0;

		// ボタンが押下された場合
		case WM_COMMAND:
			switch (LOWORD(wParam)) {
				case BUTTON_ID1:
					if (IsWindowEnabled(btnKeyPressRoop)) EnableWindow(btnKeyPressRoop, FALSE);

					keyPressRoop(VK_MENU, 10000);

					EnableWindow(btnKeyPressRoop, TRUE);
					break;
				case BUTTON_ID2:
					if (IsWindowEnabled(btnClickTargetPointWhenChangeColor)) EnableWindow(btnClickTargetPointWhenChangeColor, FALSE);

					clickTargetPointWhenChangeColor();

					EnableWindow(btnClickTargetPointWhenChangeColor, TRUE);
					break;
				case BUTTON_ID3:
					if (IsWindowEnabled(btnTsuri)) EnableWindow(btnTsuri, FALSE);

					tsuri2(hWnd);

					EnableWindow(btnTsuri, TRUE);
					return 0;
			}
			return 0;
	}

	return DefWindowProc(hWnd, msg, wParam, lParam);
}
//--------------------------------------------------------------------------
// ウィンドウを生成します。
//--------------------------------------------------------------------------
bool createWindow(HINSTANCE hInstance, HINSTANCE hPrevInstance, LPSTR lpCmdLine, int nCmdShow) {
	HWND        hWnd;
	MSG         msg;
	LPCSTR NAME = "APP";

	// 多重起動防止
	if (FindWindow(NAME, NAME) != NULL){
		MessageBox(NULL, "すでに起動しております。", NAME, MB_OK);
		return FALSE;
	}

	// Set up and register window class
	WNDCLASS wc = { CS_CLASSDC,
		WndProc,                                //イベントcallback関数
		0,
		0,
		hInstance,
		NULL,                                   //アイコン
		LoadCursor(NULL, IDC_ARROW),          //マウスカーソル
		(HBRUSH)GetStockObject(WHITE_BRUSH), //背景色
		NULL,                                   //メニュー
		NAME };                                 //クラス名
	if (RegisterClass(&wc) == 0) return FALSE;

	//ウインドウ生成
	hWnd = CreateWindow(NAME,                  //タイトルバーテキスト
		NAME,                  //クラス名
		WS_OVERLAPPEDWINDOW,   //ウインドウスタイル
		CW_USEDEFAULT,         //ウインドウ左上x座標
		0,         //ウインドウ左上y座標
		1200,         //ウインドウ幅
		1000,         //ウインドウ高さ
		NULL,                  //親ウインドウのハンドル
		NULL,
		hInstance,
		NULL);
	if (!hWnd) return FALSE;

	ShowWindow(hWnd, nCmdShow);     //Window を表示
	UpdateWindow(hWnd);             //表示を初期化
	SetFocus(hWnd);                 //フォーカスを設定

	while (GetMessage(&msg, NULL, 0, 0)){
		TranslateMessage(&msg);
		DispatchMessage(&msg);
	}
	return msg.wParam;
}
//--------------------------------------------------------------------------
// ■メイン処理
//--------------------------------------------------------------------------
int WINAPI WinMain(HINSTANCE hInstance, HINSTANCE hPrevInstance, LPSTR lpCmdLine, int nCmdShow){
	createWindow(hInstance, hPrevInstance, lpCmdLine, nCmdShow);
}
