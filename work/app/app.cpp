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
// ��UTIL�n
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
// �����_���Ȓl��Ԃ��܂��B
//--------------------------------------------------------------------------
int randRange(int range_min, int range_max)
{
	int u = (double)rand() / (RAND_MAX + 1) * (range_max - range_min) + range_min;
	return u;
}
//--------------------------------------------------------------------------
// ���Ԃ��擾���܂��B
//--------------------------------------------------------------------------
string getTime() {
	time_t timer;
	struct tm *t_st;

	// ���ݎ����̎擾
	time(&timer);

	// ���ݎ����𕶎���ɕϊ����ĕ\��
	t_st = localtime(&timer);
	char b[4096];
	sprintf(b, "[%04d-%02d-%02d %02d:%02d:%02d]", t_st->tm_year + 1900, t_st->tm_mon + 1, t_st->tm_mday, t_st->tm_hour, t_st->tm_min, t_st->tm_sec);
	string str = b;

	return str;
}
//--------------------------------------------------------------------------
// ������𕪊����܂��B
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
// ���O���o�͂��܂��B
//--------------------------------------------------------------------------
void log(string text) {
	text = getTime() + text + string("\n");
	FILE *outputfile;         // �o�̓X�g���[��

	outputfile = fopen("log.txt", "a");  // �t�@�C�����������ݗp�ɃI�[�v��(�J��)
	if (outputfile == NULL) {          // �I�[�v���Ɏ��s�����ꍇ
		//MessageBox(NULL, "���O�t�@�C�����J���܂���ł���", TITLE.c_str(), MB_OK);
		return;                         // �ُ�I��
	}

	fprintf(outputfile, text.c_str()); // �t�@�C���ɏ���

	fclose(outputfile);          // �t�@�C�����N���[�Y(����)
}
//--------------------------------------------------------------------------
// �ݒ�t�@�C����ǂݍ��݂܂��B
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
		log("�ݒ�t�@�C���̓ǂݍ��݂Ɏ��s���܂���");
	}
	return map;
}
//--------------------------------------------------------------------------
// �ő�l��Ԃ��܂��B
//--------------------------------------------------------------------------
int maxVal(vector<int> list) {
	int maxVal = 0;
	for (auto itr = list.begin(); itr != list.end(); ++itr) {
		if (*itr > maxVal) maxVal = *itr;
	}
	return maxVal;
}
//--------------------------------------------------------------------------
// �E�B���h�E�Y���b�Z�[�W���������܂��B
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
// ���L�[�{�[�h�n
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
// �L�[���������܂��B
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
// ���}�E�X�n
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
// �}�E�X���N���b�N���܂��B
//--------------------------------------------------------------------------
void MouseClickAction(){
	// �}�E�X������s�p�̃f�[�^
	INPUT inp[2];

	// �}�E�X�̍��{�^��������
	inp[0].type = INPUT_MOUSE;
	inp[0].mi.dwFlags = MOUSEEVENTF_LEFTDOWN;
	inp[0].mi.dx = 0;
	inp[0].mi.dy = 0;
	inp[0].mi.mouseData = 0;
	inp[0].mi.dwExtraInfo = 0;
	inp[0].mi.time = 0;

	// (3)�}�E�X�̍��{�^���𗣂�
	inp[1].type = INPUT_MOUSE;
	inp[1].mi.dwFlags = MOUSEEVENTF_LEFTUP;
	inp[1].mi.dx = 0;
	inp[1].mi.dy = 0;
	inp[1].mi.mouseData = 0;
	inp[1].mi.dwExtraInfo = 0;
	inp[1].mi.time = 0;

	// �}�E�X������s
	::SendInput(2, inp, sizeof(INPUT));
}
//--------------------------------------------------------------------------
// �}�E�X���N���b�N���܂��B
//--------------------------------------------------------------------------
void MouseRightClickAction(){
	// �}�E�X������s�p�̃f�[�^
	INPUT inp[2];

	// �}�E�X�̍��{�^��������
	inp[0].type = INPUT_MOUSE;
	inp[0].mi.dwFlags = MOUSEEVENTF_RIGHTDOWN;
	inp[0].mi.dx = 0;
	inp[0].mi.dy = 0;
	inp[0].mi.mouseData = 0;
	inp[0].mi.dwExtraInfo = 0;
	inp[0].mi.time = 0;

	// (3)�}�E�X�̍��{�^���𗣂�
	inp[1].type = INPUT_MOUSE;
	inp[1].mi.dwFlags = MOUSEEVENTF_RIGHTUP;
	inp[1].mi.dx = 0;
	inp[1].mi.dy = 0;
	inp[1].mi.mouseData = 0;
	inp[1].mi.dwExtraInfo = 0;
	inp[1].mi.time = 0;

	// �}�E�X������s
	::SendInput(2, inp, sizeof(INPUT));
}
//--------------------------------------------------------------------------
// �}�E�X�̍��{�^�������������܂��B
//--------------------------------------------------------------------------
void MouseClickDownAction(){
	// �}�E�X������s�p�̃f�[�^
	INPUT inp[1];

	// �}�E�X�̍��{�^��������
	inp[0].type = INPUT_MOUSE;
	inp[0].mi.dwFlags = MOUSEEVENTF_LEFTDOWN;
	inp[0].mi.dx = 0;
	inp[0].mi.dy = 0;
	inp[0].mi.mouseData = 0;
	inp[0].mi.dwExtraInfo = 0;
	inp[0].mi.time = 0;

	// �}�E�X������s
	::SendInput(1, inp, sizeof(INPUT));
}
//--------------------------------------------------------------------------
// �}�E�X�̍��{�^���𗣂��܂��B
//--------------------------------------------------------------------------
void MouseClickUpAction(){
	// �}�E�X������s�p�̃f�[�^
	INPUT inp[1];

	// (3)�}�E�X�̍��{�^���𗣂�
	inp[0].type = INPUT_MOUSE;
	inp[0].mi.dwFlags = MOUSEEVENTF_LEFTUP;
	inp[0].mi.dx = 0;
	inp[0].mi.dy = 0;
	inp[0].mi.mouseData = 0;
	inp[0].mi.dwExtraInfo = 0;
	inp[0].mi.time = 0;

	// �}�E�X������s
	::SendInput(1, inp, sizeof(INPUT));
}
//--------------------------------------------------------------------------
// �}�E�X���ړ������܂��B
//--------------------------------------------------------------------------
void MouseMoveAction(int mouseX, int mouseY){
	// �}�E�X������s�p�̃f�[�^
	INPUT inp[1];

	// (1)�}�E�X�J�[�\�����ړ�����(�X�N���[�����W)
	inp[0].type = INPUT_MOUSE;
	inp[0].mi.dwFlags = MOUSEEVENTF_MOVE | MOUSEEVENTF_ABSOLUTE;
	inp[0].mi.dx = mouseX * (65535 / GetSystemMetrics(SM_CXSCREEN));
	inp[0].mi.dy = mouseY * (65535 / GetSystemMetrics(SM_CYSCREEN));
	inp[0].mi.mouseData = 0;
	inp[0].mi.dwExtraInfo = 0;
	inp[0].mi.time = 0;

	// �}�E�X������s
	::SendInput(1, inp, sizeof(INPUT));
}
//--------------------------------------------------------------------------
// �}�E�X���ړ������܂��B�i�u���ǉ��j
//--------------------------------------------------------------------------
void MouseMoveActionWithRand(int x, int y, int randZahyo) {
	x = x + randRange(0, randZahyo);
	y = y + randRange(0, randZahyo);

	// �N���b�N
	MouseMoveAction(x, y);
}
//--------------------------------------------------------------------------
// ���F�n
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
// ���W�̐F���擾���܂��B
//--------------------------------------------------------------------------
bool outputLog = false;
COLORREF getClr(int x, int y) {
	HWND hWnd = GetDesktopWindow();
	HDC hdc = GetWindowDC(hWnd);
	COLORREF clr = GetPixel(hdc, x, y);
	ReleaseDC(hWnd, hdc);

	if (outputLog) {
		char b[4096];
		sprintf(b, "���W(%d, %d), �F:(%d,%d,%d)", x, y, GetRValue(clr), GetGValue(clr), GetBValue(clr));
		string m = b;
		log(m);
	}

	return clr;
}
//--------------------------------------------------------------------------
// ���W�̐F���擾���܂��B
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
// ���W�̐F��ݒ肵�܂��B
//--------------------------------------------------------------------------
void setClr(int x, int y, COLORREF clr) {
	HWND hWnd = GetDesktopWindow();
	HDC hdc = GetWindowDC(hWnd);
	SetPixel(hdc, x, y, clr);
	ReleaseDC(hWnd, hdc);
}
//--------------------------------------------------------------------------
// �����n
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
// WAVE�t�@�C�����������ɓǂݍ��݂܂�
// ���g������
// LPCSTR wavTargetSleep = getWaveFile("voice_taiha.wav");
// PlaySound(wavTargetSleep, NULL, SND_MEMORY | SND_ASYNC);
//--------------------------------------------------------------------------
LPCSTR getWaveFile(LPCTSTR lpFileName) {
	LPCSTR lpSound;
	HANDLE fh = CreateFile(lpFileName, GENERIC_READ, 0, NULL, OPEN_EXISTING, FILE_ATTRIBUTE_NORMAL, NULL);
	if (fh == INVALID_HANDLE_VALUE){
		MessageBox(NULL, "WAVE�t�@�C�����J���܂���", lpFileName, MB_OK);
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
// ���`�F�b�N�n
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
// �R���g���[���L�[��������Ă��邩�𔻒肵�܂��B
//--------------------------------------------------------------------------
bool checkKeyCONTROL() {
	if (GetKeyState(VK_CONTROL) < 0){
		// MessageBox(NULL, "�R���g���[���L�[��������܂����B", "checkKeyCONTROL", MB_OK);
		return true;
	}
	else {
		return false;
	}
}
//--------------------------------------------------------------------------
// �X���[�v���ɃR���g���[���L�[�������ꂽ�ꍇ�A�^��Ԃ��܂�
//--------------------------------------------------------------------------
bool sleepWithCheck(int sleepTime) {
	// ���[�v�񐔌v�Z
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
// clr���w��F�iwornClrMargin�j�͈͓̔����ǂ����𔻒肵�܂��B
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
// ���e�폈��
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
// ���Ԋu���ƂɃL�[���������܂��B
//--------------------------------------------------------------------------
void keyPressRoop(WORD key, int waitTime) {
	string funcName = "keyPressRoop";
	MessageBox(NULL, "�N�����܂��B", funcName.c_str(), MB_OK);
	while (true) {
		if (sleepWithCheck(waitTime)) break;
		KeyAction(key, FALSE);
	}

	// MessageBox(NULL, "�I�����܂��B", funcName.c_str(), MB_OK);
}
//--------------------------------------------------------------------------
// �w����W�̐F���ς������N���b�N���܂��B
//--------------------------------------------------------------------------
void clickTargetPointWhenChangeColor() {
	string funcName = "clickTargetPointWhenChangeColor";
	//MessageBox(NULL, "�N�����܂��B", funcName.c_str(), MB_OK);
	COLORREF clr = NULL;
	COLORREF clrTmp = NULL;
	POINT pt;
	// ���W��ݒ�i�L�[�������ꂽ�Ƃ��̃}�E�X�̍��W�j
	while (true) {
		if (GetKeyState('1') < 0) {
			GetCursorPos(&pt);
			clr = getClr(pt.x, pt.y);
			break;
		}
		if (sleepWithCheck(100)) break;
	}
	// �F���ς��܂őҋ@
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
// �ނ�
// 1:�N�_�ƂȂ�ʒu�Ƀ}�E�X��u���A[1]�������B
// 2:�N�_����10pixcel�c�����ׂĂ̐F���擾���č��v�B
// 3:�w�萔�l�ȏ�F�̍��v���ϓ������ꍇ�ɓ���̃L�[�������B
//--------------------------------------------------------------------------
void tsuri(HWND hWnd) {
	HDC hdc = GetDC(hWnd);
	HWND hWndDesktop = GetDesktopWindow();
	HDC hdcDesktop = GetWindowDC(hWndDesktop);
	string funcName = "tsuri";
	//MessageBox(NULL, "�N�����܂��B", funcName.c_str(), MB_OK);
	COLORREF clrTmp = NULL;
	COLORREF clrForSet = RGB(255, 0, 0);
	POINT pt;
	int hitCount = 0;
	// ���W��ݒ�i�L�[�������ꂽ�Ƃ��̃}�E�X�̍��W�j
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
	// �F���ς��܂őҋ@
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

				// �F�̋L�^
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
							// ��x�ނ�J�n��Ԃɂ��Ă���łȂ��ƒނ肠�����Ȃ��悤�ɂ���B
							renzokuFlg = FALSE;
							break;
						}
					}
					if (hitFlg == FALSE && renzokuFlg == FALSE) break;
				}

				// �F�ϓ�����
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

	//�X�N���[���̏��𓾂�
	// RECT rc;
	// int width, height;
	// GetWindowRect(desktop, &rc);
	// width = rc.right;
	// height = rc.bottom;
	int width = 40;
	int height = 30;

	// ���W��ݒ�i�L�[�������ꂽ�Ƃ��̃}�E�X�̍��W�j
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
	// ���W0, 0���܂ނ��߁A+1���Ă���B
	int sX = pt.x - width + 1;
	int sY = pt.y - height + 1;

	//DIB�̏���ݒ肷��
	BITMAPINFO bmpInfo;
	bmpInfo.bmiHeader.biSize = sizeof(BITMAPINFOHEADER);
	bmpInfo.bmiHeader.biWidth = width;
	bmpInfo.bmiHeader.biHeight = height;
	bmpInfo.bmiHeader.biPlanes = 1;
	bmpInfo.bmiHeader.biBitCount = 32;
	bmpInfo.bmiHeader.biCompression = BI_RGB;

	//DIBSection�쐬
	LPDWORD lpPixel;
	HBITMAP hBitmap = CreateDIBSection(hdc, &bmpInfo, DIB_RGB_COLORS, (void**)&lpPixel, NULL, 0);
	HDC hMemDC = CreateCompatibleDC(hdc);
	SelectObject(hMemDC, hBitmap);

	//�\��ʂ֓]��
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

		//�X�N���[����DIBSection�ɃR�s�[
		BitBlt(hMemDC, 0, 0, width, height, hdcDesktop, sX, sY, SRCCOPY);
		BitBlt(hdc, 200, 0, width, height, hMemDC, 0, 0, SRCCOPY);

		// �F�̋L�^
		bool hitFlg = TRUE;
		for (int y = 0; y < height; y++) {
			for (int x = 0; x < width; x++) {
				
				char b[32];
				sprintf(b, "(%02x, %02x, %02x)", ((lpPixel[x + y * width] >> 16) & 0xff), ((lpPixel[x + y * width] >> 8) & 0xff), (lpPixel[x + y * width] & 0xff));
				string m = b;
				TextOut(hdc, (200 + width + x * 100), ((height * 20) - (y * 20)), m.c_str(), 32);

				if (((lpPixel[x + y * width] >> 16) & 0xff) >= 0xB4 && ((lpPixel[x + y * width] >> 8) & 0xff) >= 0xB4) {
 					hitFlg = FALSE;
 					// ��x�ނ�J�n��Ԃɂ��Ă���łȂ��ƒނ肠�����Ȃ��悤�ɂ���B
 					renzokuFlg = FALSE;
					break;
 				}
			}
			if (hitFlg == FALSE && renzokuFlg == FALSE) break;
		}

		// �F�ϓ�����
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
	//����lpPixel���������ׂ��炸
	DeleteDC(hMemDC);
	DeleteObject(hBitmap);  //BMP���폜�������AlpPixel�������I�ɉ�������
}
//--------------------------------------------------------------------------
// ���E�B���h�E�n
//--------------------------------------------------------------------------
//�v���g�^�C�v�錾
LRESULT  CALLBACK   WndProc(HWND, UINT, WPARAM, LPARAM);
int      WINAPI     WinMain(HINSTANCE, HINSTANCE, LPSTR, int);
// ID
#define BUTTON_ID1 1
#define BUTTON_ID2 2
#define BUTTON_ID3 3
//Windws �C�x���g�p�֐�
LRESULT  CALLBACK  WndProc(HWND hWnd, UINT msg, WPARAM wParam, LPARAM lParam){
	static HWND btnKeyPressRoop;
	static HWND btnClickTargetPointWhenChangeColor;
	static HWND btnTsuri;

	//�n���ꂽ message ����A�C�x���g�̎�ނ���͂���
	switch (msg){
		case WM_CREATE:
			// �{�^���z�u
			btnKeyPressRoop = CreateWindow(
				TEXT("BUTTON"), TEXT("keyPressRoop"),
				WS_CHILD | WS_VISIBLE | BS_PUSHBUTTON,
				0, 0, 200, 40,
				hWnd, (HMENU)BUTTON_ID1, ((LPCREATESTRUCT)(lParam))->hInstance, NULL
				);
			// �{�^���z�u
			btnClickTargetPointWhenChangeColor = CreateWindow(
				TEXT("BUTTON"), TEXT("clickPoint"),
				WS_CHILD | WS_VISIBLE | BS_PUSHBUTTON,
				0, 40, 200, 40,
				hWnd, (HMENU)BUTTON_ID2, ((LPCREATESTRUCT)(lParam))->hInstance, NULL
				);
			// �{�^���z�u
			btnTsuri = CreateWindow(
				TEXT("BUTTON"), TEXT("�ނ�"),
				WS_CHILD | WS_VISIBLE | BS_PUSHBUTTON,
				0, 80, 200, 40,
				hWnd, (HMENU)BUTTON_ID3, ((LPCREATESTRUCT)(lParam))->hInstance, NULL
				);
			break;

		// �I��
		case WM_DESTROY:
			PostQuitMessage(0);
			return 0;

		// �{�^�����������ꂽ�ꍇ
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
// �E�B���h�E�𐶐����܂��B
//--------------------------------------------------------------------------
bool createWindow(HINSTANCE hInstance, HINSTANCE hPrevInstance, LPSTR lpCmdLine, int nCmdShow) {
	HWND        hWnd;
	MSG         msg;
	LPCSTR NAME = "APP";

	// ���d�N���h�~
	if (FindWindow(NAME, NAME) != NULL){
		MessageBox(NULL, "���łɋN�����Ă���܂��B", NAME, MB_OK);
		return FALSE;
	}

	// Set up and register window class
	WNDCLASS wc = { CS_CLASSDC,
		WndProc,                                //�C�x���gcallback�֐�
		0,
		0,
		hInstance,
		NULL,                                   //�A�C�R��
		LoadCursor(NULL, IDC_ARROW),          //�}�E�X�J�[�\��
		(HBRUSH)GetStockObject(WHITE_BRUSH), //�w�i�F
		NULL,                                   //���j���[
		NAME };                                 //�N���X��
	if (RegisterClass(&wc) == 0) return FALSE;

	//�E�C���h�E����
	hWnd = CreateWindow(NAME,                  //�^�C�g���o�[�e�L�X�g
		NAME,                  //�N���X��
		WS_OVERLAPPEDWINDOW,   //�E�C���h�E�X�^�C��
		CW_USEDEFAULT,         //�E�C���h�E����x���W
		0,         //�E�C���h�E����y���W
		1200,         //�E�C���h�E��
		1000,         //�E�C���h�E����
		NULL,                  //�e�E�C���h�E�̃n���h��
		NULL,
		hInstance,
		NULL);
	if (!hWnd) return FALSE;

	ShowWindow(hWnd, nCmdShow);     //Window ��\��
	UpdateWindow(hWnd);             //�\����������
	SetFocus(hWnd);                 //�t�H�[�J�X��ݒ�

	while (GetMessage(&msg, NULL, 0, 0)){
		TranslateMessage(&msg);
		DispatchMessage(&msg);
	}
	return msg.wParam;
}
//--------------------------------------------------------------------------
// �����C������
//--------------------------------------------------------------------------
int WINAPI WinMain(HINSTANCE hInstance, HINSTANCE hPrevInstance, LPSTR lpCmdLine, int nCmdShow){
	createWindow(hInstance, hPrevInstance, lpCmdLine, nCmdShow);
}
