<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php'; addHTTPHeader(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>MSX-MIDI</title>
  <?php addStyles(); ?>
</head>
<body>
<?php addHeader(); ?>



<h1 title="第5部 MSX-MIDI">Section 5 MSX-MIDI</h1>

<p>From MSX Datapack Vol. 3</p>
<p>Translated by Laurens Holst</p>

<p>Attached files: <a href="thru.mac">thru.mac</a>,
<a href="thru.doc">thru.doc</a>, <a href="thru.com">thru.com</a></p>

<h2 title="1章 MSX-MIDIとは">Chapter 1: About MSX-MIDI</h2>

<p>
<span title="MSX-MIDIとは、これまでのMSX-MUSICにMIDI (Musical Instrument Digital Interface) 機能を追加したもので、拡張BASIC命令で、MIDIを利用することができます。">
With MSX-MIDI, MIDI functionality and BASIC extensions were added to MSX-MUSIC to enable it to use MIDI.</span>
<span title="MSX-MUSICとは異なり、BIOSはありません。">
Unlike MSX-MUSIC, there is no BIOS.</span>
<span title="BASIC以外でMSX-MIDIを使うプログラムは、I/Oポートから直接ハードウェアをアクセスします。">
Non-BASIC MSX-MIDI programs directly access the hardware from the I/O ports.</span>
</p>

<p>
<span title="MSX-MIDIは本体に内蔵することも、外付けカートリッジにすることもできます。">
MSX-MIDI can be both built into the machine body, or an external cartridge.</span>
<span title="MSX-MIDIは、MSX turbo R以降の専用です。">
MSX MIDI is only available to MSX turbo R and later.</span>
<span title="MSX、MSX2、MSX2+では使用できません。">
It can not be used on MSX, MSX<sub>2</sub> and MSX<sub>2+</sub>.</span>
</p>

<p title="MSX-MIDIは次のような構成になっています。">
MSX-MIDI is organized as follows:</p>

<ul>
<li>
<p title="MIDIインターフェイス">MIDI interface</p>

<table>
<tr>
<td title="8251">8251</td>
<td title="MIDIデータ通信用IC">MIDI data communication IC</td>
</tr>
<tr>
<td title="8253または8254">8253 or 8254</td>
<td title="ボーレートジェネレータおよびタイマー用IC">Baud rate generator and timer IC</td>
</tr>
</table>

<p title="これらのICに対しては、I/Oポートからアクセスします。">
These ICs can be accessed through the I/O ports.
</p>
</li>

<li>
<p title="MSX-MIDI ROM (16Kバイト)">MSX-MIDI ROM (16K bytes)</p>

<p title="本体内蔵の場合は、これまでのMSX-MUSICと同じスロット (スロット0-2、ページ1) に配置します。">
In case it is built-in, it is placed in the same slot as the MSX-Music (slot 0-2, page 1).</p>

<p>
<span title="外付けカートリッジの場合は、カートリッジ上に実装します。">
In case it is an external cartridge, it is included on the cartridge.</span>
<span title="拡張BASIC命令を使うときは、本体内蔵のMSX-MUSICは使用せず、外付けカートリッジのMSX-MIDIを使うよう初期化されます。">
When the BASIC extensions are used, it is initialized to use external cartridge’s MSX-MIDI instead of the built-in MSX-MUSIC.</span>
</p>
</li>
</ul>


<h2 title="2章 ハードウェア">Chapter 2: Hardware</h2>

<p>
<span title="MSX-MIDIは、内蔵と外付けによって、ハードウェア構成やアクセス方法が異なります。">
Between internal or external MSX-MIDI, the hardware configuration and access methods and such is different.</span>
<span title="以下では、MSX-MIDIのハードウェア構成について説明します。">
What follows is a description of the MSX MIDI hardware configuration.</span>
</p>

<p title="なお、タイマー用ICとして8253または8254を使用しますが、以下では「8253」と表記します。">
Additionally, regardless of whether timer IC 8253 or 8254 is used, it will henceforth be referred to as “8253”.</p>

<h3 title="2.1 ブロック図">2.1 Block Diagram</h3>

<p title="MSX-MIDIのハードウェアは以下のような構成になっています。">
The MSX-MIDI hardware is organised as follows:</p>

<p>
<img src="figure-4.1.png" alt="MSX-MIDI block diagram" />
</p>

<p title="図4.1 MSX-MIDIのブロック図">
Figure 4.1 MSX-MIDI block diagram</p>

<h3 title="2.2 内蔵MIDIインターフェイス">
2.2 Internal MIDI interface</h3>

<p title="本体に内蔵されたMSX-MIDIインターフェイスのI/Oポートは、次のように割り当てられています。">
The I/O ports of the built-in MSX-MIDI interface are assigned as follows:</p>

<ul>
<li>
<p title="8251インターフェイス (0E8H、0E9H番地)">
8251 interface (address 0E8H, 0E9H)</p>

<table>
<tr>
<th></th><th></th>
<th>b7</th><th>b6</th><th>b5</th><th>b4</th><th>b3</th><th>b2</th><th>b1</th><th>b0</th>
</tr>
<tr>
<th>0E8H</th><th>(Read)</th>
<td>RXD7</td><td>RXD6</td><td>RXD5</td><td>RXD4</td><td>RXD3</td><td>RXD2</td><td>RXD1</td><td>RXD0</td>
</tr>
<tr>
<th></th><th>(Write)</th>
<td>TXD7</td><td>TXD6</td><td>TXD5</td><td>TXD4</td><td>TXD3</td><td>TXD2</td><td>TXD1</td><td>TXD0</td>
</tr>
</table>

<table>
<tr>
<td title="RXD7～RXD0">RXD7-RXD0</td>
<td title="8251受信データ">8251 receive data</td>
</tr>
<tr>
<td title="TXD7～TXD0">TXD7-TXD0</td>
<td title="8251送信データ">8251 transmit data</td>
</tr>
</table>

<table>
<tr>
<th></th><th></th>
<th>b7</th><th>b6</th><th>b5</th><th>b4</th><th>b3</th><th>b2</th><th>b1</th><th>b0</th>
</tr>
<tr>
<th>0E9H</th><th>(Read)</th>
<td>DSR</td><td>BRK</td><td>FE</td><td>OE</td><td>PE</td><td>EMPT</td><td>RRDY</td><td>TRDY</td>
</tr>
</table>

<table>
<tr>
<td>DSR</td>
<td title="8253タイマー割り込みフラグ">8253 timer interrupt flag</td>
<td title="(1=割り込み発生)">(1=interrupt occurs)</td>
</tr>
<tr>
<td>BRK</td>
<td title="8251ブレークコード検出">8251 break code detection</td>
<td title="(1=検出)">(1=detected)</td>
</tr>
<tr>
<td>FE</td>
<td title="8251フレームエラーフラグ">8251 frame error flag</td>
<td title="(1=エラー発生)">(1=error occurs)</td>
</tr>
<tr>
<td>OE</td>
<td title="8251オーバーランエラーフラグ">8251 overrun error flag</td>
<td title="(1=エラー発生)">(1=error occurs)</td>
</tr>
<tr>
<td>PE</td>
<td title="8251パリティエラーフラグ">8251 parity error flag</td>
<td title="(1=パリティエラー発生)">(1=parity error occurs)</td>
</tr>
<tr>
<td>EMPT</td>
<td title="8251送信バッファステータス">8251 transmit buffer status</td>
<td title="(1=送信バッファ空)">(1=transmit buffer empty)</td>
</tr>
<tr>
<td>RRDY</td>
<td title="8251受信バッファステータス">8251 receive buffer status</td>
<td title="(1=データ有り)">(1=data available)</td>
</tr>
<tr>
<td>TRDY</td>
<td title="8251送信ステータス">8251 transmit status</td>
<td title="(1=送信可能)">(1=transmission possible)</td>
</tr>
</table>

<table>
<tr>
<th>0E9H</th><th>(Write)</th>
<th>b7</th><th>b6</th><th>b5</th><th>b4</th><th>b3</th><th>b2</th><th>b1</th><th>b0</th>
</tr>
<tr>
<th></th><th title="モード">Mode</th>
<td>S2</td><td>S1</td><td>EP</td><td>PEN</td><td>L2</td><td>L1</td><td>B2</td><td>B1</td>
</tr>
<tr>
<th></th><th title="コマンド">Command</th>
<td>EH</td><td>IR</td><td>RIE</td><td>ER</td><td>SBRK</td><td>RE</td><td>TIE</td><td>TEN</td>
</tr>
</table>

<table>
<tr>
<td>EH</td>
<td title="通常0に設定します">Normally set to 0</td>
<td></td>
</tr>
<tr>
<td>IR</td>
<td title="通常0に設定します">Normally set to 0</td>
<td></td>
</tr>
<tr>
<td>RIE</td>
<td title="MIDI IN割り込み許可">MIDI IN interrupt enable</td>
<td title="(1=許可、0=禁止)">(1=enable, 0=disable)</td>
</tr>
<tr>
<td>ER</td>
<td title="エラーリセット">Error reset</td>
<td title="(1=エラーフラグのリセット)&#xA;(0=ノー• オペレーション)">
(1=reset error flag)<br />(0=no operation)</td>
</tr>
<tr>
<td>SBRK</td>
<td title="通常0に設定します">Normally set to 0</td>
<td></td>
</tr>
<tr>
<td>RE</td>
<td title="MIDI IN受信イネーブル">MIDI IN receive enable</td>
<td title="(1=許可、0=禁止)">(1=enable, 0=disable)</td>
</tr>
<tr>
<td>TIE</td>
<td title="8253タイマー (カウンタ#2)&#xA;割り込み許可">
8253 timer (counter #2)<br />interrupt enable</td>
<td title="(1=許可、0=禁止)">(1=enable, 0=disable)</td>
</tr>
<tr>
<td>TEN</td>
<td title="MIDI OUT送信イネーブル">MIDI OUT transmit enable</td>
<td title="(1=許可、0=禁止)">(1=enable, 0=disable)</td>
</tr>
</table>

<p>
<span title="8251のコマンド• モードレジスタの書き込み回復時間は、最大16クロック (3.579545MHz) 必要です。">
For 8251 command / mode register writes, a recovery time of at most 16 clock ticks (at 3.579545MHz) is necessary.</span>
<span title="8251の初期化など、連続してコマンド• モードレジスタに書き込みをする際は、ウェイトを入れて下さい。">
When writing to the command / mode register continuously, please insert a wait to allow the 8251 to reinitialise.</span>
</p>

<p>
<span title="8251はI/Oポートの0E9Hに00H、00H、00H、40Hを書き込むと、リセットされます。">
By writing 00H, 00H, 00H, 40H to I/O port 0E9H, the 8251 is reset.</span>
<span title="モードに誤った値を設定すると、MIDIとして機能しなくなるので、リセット後は必ず特定の値を設定します。">
It will no longer function as MIDI if an incorrect mode value is configured, so after a reset always set it to a specific value.</span>
<span title="詳細は、添付のサンプルプログラム (「THRU.MAC」) を参照して下さい。">
For more information, please see the attached <a href="thru.mac">sample program</a> (THRU.MAC).</span>
</p>
</li>

<li>
<p title="8253 OUT2端子の信号のラッチ (0EAH、0EBH番地)">
8253 OUT2 latch pin signal (address 0EAH, 0EBH)</p>

<table>
<tr>
<th></th><th></th>
<th>b7</th><th>b6</th><th>b5</th><th>b4</th><th>b3</th><th>b2</th><th>b1</th><th>b0</th>
</tr>
<tr>
<th>0EAH</th><th>(Write)</th>
<td>—</td><td>—</td><td>—</td><td>—</td><td>—</td><td>—</td><td>—</td><td>—</td>
</tr>
</table>

<table>
<tr>
<td title="0EAH番地のデータリードは無効">
Reading address 0EAH is invalid</td>
</tr>
<tr>
<td title="0EBH番地は0EAH番地のイメージ">
Address 0EBH is an image of 0EAH</td>
</tr>
</table>

<p title="8253のカウンタ#2からの割り込みは、0EAH番地への任意のデータ書き込みによって解除されます。">
The interrupt from counter #2 is released by writing any data to address 0EAH.</p>
</li>

<li>
<p title="8253インターフェイス (0ECH～0EFH番地)">
8253 Interface (address 0ECH-0EFH)</p>

<table>
<tr>
<th></th><th></th>
<th>b7</th><th>b6</th><th>b5</th><th>b4</th><th>b3</th><th>b2</th><th>b1</th><th>b0</th>
</tr>
<tr>
<th>0ECH</th><th>(R/W)</th>
<td>CT07</td><td>CT06</td><td>CT05</td><td>CT04</td><td>CT03</td><td>CT02</td><td>CT01</td><td>CT00</td>
</tr>
<tr>
<th>0EDH</th><th>(R/W)</th>
<td>CT17</td><td>CT16</td><td>CT15</td><td>CT14</td><td>CT13</td><td>CT12</td><td>CT11</td><td>CT10</td>
</tr>
<tr>
<th>0EEH</th><th>(R/W)</th>
<td>CT27</td><td>CT26</td><td>CT25</td><td>CT24</td><td>CT23</td><td>CT22</td><td>CT21</td><td>CT20</td>
</tr>
<tr>
<th>0EFH</th><th>(Read)</th>
<td>—</td><td>—</td><td>—</td><td>—</td><td>—</td><td>—</td><td>—</td><td>—</td>
</tr>
<tr>
<th></th><th>(Write)</th>
<td>SC1</td><td>SC0</td><td>RW1</td><td>RW0</td><td>M2</td><td>M1</td><td>M0</td><td>BCD</td>
</tr>
</table>

<table>
<tr>
<td title="CT07～CT00">CT07-CT00</td>
<td title="カウンタ#0">Counter #0</td>
</tr>
<tr>
<td title="CT17～CT10">CT17-CT10</td>
<td title="カウンタ#1">Counter #1</td>
</tr>
<tr>
<td title="CT27～CT20">CT27-CT20</td>
<td title="カウンタ#2">Counter #2</td>
</tr>
<tr>
<td title="SC1、SC0">SC1, SC0</td>
<td title="カウンタ選択、コマンド選択">Counter select, command select</td>
</tr>
<tr>
<td title="RW1、RW0">RW1, RW0</td>
<td title="カウンタリードライトモード">Counter read-write mode</td>
</tr>
<tr>
<td title="M2、M1、M0">M2, M1, M0</td>
<td title="カウンタモード">Counter mode</td>
</tr>
<tr>
<td title="BCD">BCD</td>
<td title="バイナリ、BCDカウント選択">Binary / BCD count select</td>
</tr>
</table>

<p title="各カウンタの機能は次のようになっています。">
The function of each counter is as follows:</p>

<ul>
<li>
<p title="カウンタ#0">Counter #0</p>

<p>
<span title="8251のボーレートジェネレータとして使われます。">
Is used as the 8251’s baud rate generator.</span>
<span title="CLK端子には4MHzのクロック信号が入力されています。">
A 4 MHz clock signal is input to the CLK pin.</span>
<span title="8251に対しては、ボーレートクロックとして500KHzを送信する (8分周する) ように設定しなければなりません。">
For the 8251, it must be configured to transmit a baud rate clock of 500 KHz (divided by 8).</span>
<span title="モードは3 (方形波N分周モード) で使用します。">
Use mode 3 (square wave divide-by-N mode).</span>
</p>
</li>

<li>
<p title="カウンタ#1">Counter #1</p>

<p>
<span title="汎用のカウンタとして使うことができます。">
Can be used as general-purpose counter.</span>
<span title="CLK端子にはカウンタ#2の出力が入力されています。">
The output of counter #2 is input to the CLK pin.</span>
</p>
</li>

<li>
<p title="カウンタ#2">Counter #2</p>

<p>
<span title="CPUへの周期的な割り込みに使用されます (BASICでは5ミリ秒間隔の割り込みとして使用される)。">
Used as a periodic interrupt to the CPU (used by BASIC for 5 ms interval interrupts).</span>
<span title="通常、モード2 (N分周モード) で使用します。">
Normally, mode 2 (divide-by-N mode) is used.</span>
<span title="OUT2端子がLOWになると、ラッチ回路を通してCPUに割り込みを発生します。">
OUT2 pin goes low, and through the latch circuit a CPU interrupt is generated.</span>
<span title="CLK端子には4MHzのクロックが入力されます。">
A 4 MHz clock is input to the CLK pin.</span>
</p>
</li>
</ul>

</li>
</ul>


<h3 title="2.3 外付けMIDIインターフェイス">2.3 External MIDI Interface</h3>

<p title="外付けのMSX-MIDIインターフェイスは、I/Oポートの0E2Hに値を設定することによって、I/Oポートのアドレスが変わります。">
The external MSX-MIDI interface’s I/O port address can be changed by setting a value to I/O port 0E2H.

</p>

<ul>
<li>
<p title="MIDIインターフェイスの設定 (0E2H、0EAH番地)">
MIDI interface configuration (address 0E2H, 0EAH)</p>

<table>
<tr>
<th></th><th></th>
<th>b7</th><th>b6</th><th>b5</th><th>b4</th><th>b3</th><th>b2</th><th>b1</th><th>b0</th>
</tr>
<tr>
<th>0E2H</th><th>(Write)</th>
<td>EN</td><td>—</td><td>—</td><td>—</td><td>—</td><td>—</td><td>—</td><td>E8</td>
</tr>
</table>

<table>
<tr>
<td>EN</td>
<td title="MIDIインターフェイスの使用許可、禁止&#xA;初期値は1。">
MIDI interface usage allow / deny<br />Initial value is 1.</td>
<td title="(0=許可、1=禁止)">(0=allow, 1=deny)</td>
</tr>
<tr>
<td>E8</td>
<td title="8251アドレス設定&#xA;初期値は1。">
8251 address configuration<br />Initial value is 1.</td>
<td title="(1=0E0H、0E1H番地)&#xA;(0=0E8H、0E9H番地)">
(1=address 0E0H, 0E1H)<br />(0=address 0E8H, 0E9H)</td>
</tr>
</table>

<p>
<span title="E8ビットを0に設定すると、外付けカートリッジのMIDIインターフェイスのI/Oポートは、0E2Hから0EAHに変わり、内蔵MIDIインターフェイスとコンパチブルになります。">
Set bit E8 to 0, and the external cartridge MIDI interface’s I/O ports change from 0E2H to 0EAH, becoming compatible with the internal MIDI interface.</span>
<span title="また、8251のI/Oアドレスは、0E8Hと0E9Hになります。">
Also, the 8251’s I/O address becomes 0E8H and 0E9H.</span>
</p>

<p>
<span title="E8ビットを1に設定すると、8251インターフェイスは0E0H、0E1H番地になり、カートリッジのI/Oの0ECH～0EFHへのアクセスは禁止されます。">
Set bit E8 to 1 and the 8251 interface addresses will be 0E0H and 0E1H, and access to the cartridge’s I/O ports 0ECH-0EFH will be prohibited.</span>
<span title="また、8253のタイマー割り込みも禁止されます。">
Additionally, the 8253’s timer interrupt is also inhibited.</span>
</p>
</li>

<li>
<p title="8251インターフェイス (0E0H、0E1H番地)">8251 interface (address 0E0H, 0E1H)</p>

<p title="(E8ビットが1の場合)">(in case E8 bit is 1)</p>

<table>
<tr>
<th></th><th></th>
<th>b7</th><th>b6</th><th>b5</th><th>b4</th><th>b3</th><th>b2</th><th>b1</th><th>b0</th>
</tr>
<tr>
<th>0E0H</th><th>(Read)</th>
<td>RXD7</td><td>RXD6</td><td>RXD5</td><td>RXD4</td><td>RXD3</td><td>RXD2</td><td>RXD1</td><td>RXD0</td>
</tr>
<tr>
<th></th><th>(Write)</th>
<td>TXD7</td><td>TXD6</td><td>TXD5</td><td>TXD4</td><td>TXD3</td><td>TXD2</td><td>TXD1</td><td>TXD0</td>
</tr>
</table>

<table>
<tr>
<td title="RXD7～RXD0">RXD7-RXD0</td>
<td title="8251受信データ">8251 receive data</td>
</tr>
<tr>
<td title="TXD7～TXD0">TXD7-TXD0</td>
<td title="8251送信データ">8251 transmit data</td>
</tr>
</table>

<table>
<tr>
<th></th><th></th>
<th>b7</th><th>b6</th><th>b5</th><th>b4</th><th>b3</th><th>b2</th><th>b1</th><th>b0</th>
</tr>
<tr>
<th>0E1H</th><th>(Read)</th>
<td>DSR</td><td>BRK</td><td>FE</td><td>OE</td><td>PE</td><td>EMPT</td><td>RRDY</td><td>TRDY</td>
</tr>
</table>

<table>
<tr>
<td>DSR</td>
<td title="8253タイマー割り込みフラグ">8253 timer interrupt flag</td>
<td title="(1=割り込み発生)">(1=interrupt occurs)</td>
</tr>
<tr>
<td>BRK</td>
<td title="8251ブレークコード検出">8251 break code detection</td>
<td title="(1=検出)">(1=detected)</td>
</tr>
<tr>
<td>FE</td>
<td title="8251フレームエラーフラグ">8251 frame error flag</td>
<td title="(1=エラー発生)">(1=error occurs)</td>
</tr>
<tr>
<td>OE</td>
<td title="8251オーバーランエラーフラグ">8251 overrun error flag</td>
<td title="(1=エラー発生)">(1=error occurs)</td>
</tr>
<tr>
<td>PE</td>
<td title="8251パリティエラーフラグ">8251 parity error flag</td>
<td title="(1=パリティエラー発生)">(1=parity error occurs)</td>
</tr>
<tr>
<td>EMPT</td>
<td title="8251送信バッファステータス">8251 transmit buffer status</td>
<td title="(1=送信バッファ空)">(1=transmit buffer empty)</td>
</tr>
<tr>
<td>RRDY</td>
<td title="8251受信バッファステータス">8251 receive buffer status</td>
<td title="(1=データ有り)">(1=data available)</td>
</tr>
<tr>
<td>TRDY</td>
<td title="8251送信ステータス">8251 transmit status</td>
<td title="(1=送信可能)">(1=transmission possible)</td>
</tr>
</table>

<table>
<tr>
<th>0E1H</th><th>(Write)</th>
<th>b7</th><th>b6</th><th>b5</th><th>b4</th><th>b3</th><th>b2</th><th>b1</th><th>b0</th>
</tr>
<tr>
<th></th><th title="モード">Mode</th>
<td>S2</td><td>S1</td><td>EP</td><td>PEN</td><td>L2</td><td>L1</td><td>B2</td><td>B1</td>
</tr>
<tr>
<th></th><th title="コマンド">Command</th>
<td>EH</td><td>IR</td><td>RIE</td><td>ER</td><td>SBRK</td><td>RE</td><td>TIE</td><td>TEN</td>
</tr>
</table>

<table>
<tr>
<td>EH</td>
<td title="通常0に設定します">Normally set to 0</td>
<td></td>
</tr>
<tr>
<td>IR</td>
<td title="通常0に設定します">Normally set to 0</td>
<td></td>
</tr>
<tr>
<td>RIE</td>
<td title="MIDI IN割り込み許可">MIDI IN interrupt enable</td>
<td title="(1=許可、0=禁止)">(1=enable, 0=disable)</td>
</tr>
<tr>
<td>ER</td>
<td title="エラーリセット">Error reset</td>
<td title="(1=エラーフラグのリセット)&#xA;(0=ノー• オペレーション)">
(1=reset error flag)<br />(0=no operation)</td>
</tr>
<tr>
<td>SBRK</td>
<td title="通常0に設定します">Normally set to 0</td>
<td></td>
</tr>
<tr>
<td>RE</td>
<td title="MIDI IN受信イネーブル">MIDI IN receive enable</td>
<td title="(1=許可、0=禁止)">(1=enable, 0=disable)</td>
</tr>
<tr>
<td>TIE</td>
<td title="8253タイマー (カウンタ#2)&#xA;割り込み許可">
8253 timer (counter #2)<br />interrupt enable</td>
<td title="(1=許可、0=禁止)">(1=enable, 0=disable)</td>
</tr>
<tr>
<td>TEN</td>
<td title="MIDI OUT送信イネーブル">MIDI OUT transmit enable</td>
<td title="(1=許可、0=禁止)">(1=enable, 0=disable)</td>
</tr>
</table>
</li>
</ul>


<h3 title="2.4 内蔵タイプと外付けタイプとの見分け方">
2.4 Method to distinguish internal from external type</h3>

<p title="MAIN ROMの002EH番地のビット0が1の場合は、MSX-MIDIは内蔵されています。">
In case bit 0 of MAIN ROM address 002EH is 1, the MSX-MIDI is internal.</p>

<p title="MAIN ROMのバージョン番号 (【002DH】) が03H以上の機種では、外付けカートリッジでMSX-MIDIの機能を使うことができます。">
In models whose MAIN ROM version number (002DH) is 03H or more, the features of the MSX-MIDI can be used with an external cartridge.</p>

<p>
<span title="内蔵タイプと外付けタイプとでは、フックが異なっています。">
In the internal type and the external type, the hook is different.</span>
<span title="この違いはアプリケーションを作成する上で重要です。">
This distinction is important in order to create an application.</span>
<span title="フックについては、3.2「フック」と4章「アプリケーション開発の注意」を参照して下さい。">
For hooks, please see 3.2 “Hooks” and chapter 4 “Application development”.</span>
</p>

<p title="内蔵タイプと外付けタイプとを判別するには、MSX-MIDIのROMの4018H番地からの文字列を調べます。">
To make the distinction between internal type and external type, examine the string starting at MSX MIDI ROM address 4018H.</p>

<table>
<caption title="表 4.1 MSX-MIDIの判別用文字列">
Table 4.1 String to distinguish MSX-MIDI</caption>
<tr>
<th title="アドレス">Address</th>
<th title="内蔵">Internal</th>
<th title="外付け">External</th>
</tr>
<tr><td>4018H</td><td>41H (A)</td><td>??H (?)</td></tr>
<tr><td>4019H</td><td>50H (P)</td><td>??H (?)</td></tr>
<tr><td>401AH</td><td>52H (R)</td><td>??H (?)</td></tr>
<tr><td>401BH</td><td>4CH (L)</td><td>??H (?)</td></tr>
<tr><td>401CH</td><td>4FH (O)</td><td>4DH (M)</td></tr>
<tr><td>401DH</td><td>50H (P)</td><td>49H (I)</td></tr>
<tr><td>401EH</td><td>4CH (L)</td><td>44H (D)</td></tr>
<tr><td>401FH</td><td>4CH (L)</td><td>49H (I)</td></tr>
</table>

<p>
<span title="外付けカートリッジでは、4018Hからの4バイトはメーカーごとに異なる任意のデータになります。">
In external cartridges, the 4 unspecified bytes at 4018H are different for each manufacturer.</span>
<span title="401CHからのデータは「MIDI」となっています。">
The data at 401CH consists of “MIDI”.</span>
</p>


<h3 title="2.5 MIDIインターフェイスの有無の判別方法">
2.5 Method to detect presence of MIDI interface</h3>

<p title="MIDIインターフェイスの有無は、次のように判別します。">
The presence or absence of the MIDI interface can be determined in the following manner:</p>

<ol>
<li>
<p title="MAIN ROMの002EH番地のビット0が1の場合、MIDIインターフェイスは内蔵されています。">
In case MAIN ROM address 002EH bit 0 is 1, the MIDI interface is internal.</p>
</li>

<li>
<p title="MAIN ROMのバージョン番号 (002DH) が03H以上の場合、401CH～401FHに次の内容を持つスロットを探します。">
In case the MAIN ROM version number (002DH) is 03H or more, look for a slot which contains the following in 401CH-401FH:</p>

<pre>    DB "MIDI"</pre>

<p title="もしあれば、外付けカートリッジが実装されています。">
If it exists, the external cartridge is inserted.</p>
</li>

<li>
<p title="以上のことにあてはまらない場合、MIDIインターフェイスは存在しないので、MIDI機能は使用できません。">
When the above cases do not apply, since there is no MIDI interface, the MIDI function can not be used.</p>
</li>

<li>
<p title="ROMのバージョン番号 (002DH) が02H以下の場合、MIDIインターフェイスは使用できません。">
In case the ROM version number is 02H or less, the MIDI interface can not be used.</p>
</li>
</ol>


<h2 title="3章 割り込み">Chapter 3: Interrupts</h2>

<h3 title="3.1 BASICでの割り込み">3.1 Interrupts in BASIC</h3>

<p title="MSX-MUSICのための割り込みは、1/60秒 (NTSC) または1/50秒 (PAL) を使用してきましたが、MSX-MIDIの拡張BASICでは、8253からの5ミリ秒割り込みを使用します。">
1/60 sec (NTSC) or 1/50 sec (PAL) interrupts have been used for the MSX-MUSIC, but in the MSX-MIDI BASIC extensions 5 ms interrupts from the 8253 are used.</p>

<h3 title="3.2 フック">3.2 Hooks</h3>

<p title="MSX turbo R本体に内蔵されたMSX-MIDIのフックは次のようになっています。">
The MSX turbo R built-in MSX-MIDI’s hooks are as follows:</p>

<table>
<caption title="表 4.2 内蔵MSX-MIDIのフック">
Table 4.2 Internal MSX-MIDI hooks</caption>
<tr>
<th title="アドレス">Address</th>
<th title="名称">Name</th>
<th title="旧名称">Former name</th>
<th title="内容">Content</th>
</tr>
<tr>
<td>0FF75H</td>
<td>H.MDIN</td>
<td>H.OKNORM</td>
<td title="MIDI IN割り込み">MIDI IN interrupt</td>
</tr>
<tr>
<td>0FF93H</td>
<td>H.MDTM</td>
<td>H.FRQINT</td>
<td title="8253タイマー割り込み">8253 timer interrupt</td>
</tr>
</table>

<p>
<span title="外付けカートリッジの場合、これらのフックは使えないので、H.KEYIを使って下さい。">
In case of external cartridge, because these hooks can not be used, please use H.KEYI.</span>
<span title="使用法の詳細は、4章「アプリケーションの開発」で解説します。">
Usage details are described in chapter 4 “Application Development”.</span>
</p>

<table>
<caption title="表 4.3 外付けMSX-MIDIのフック">
Table 4.3 External MSX-MIDI hooks</caption>
<tr>
<th title="アドレス">Address</th>
<th title="名称">Name</th>
</tr>
<tr>
<td>0FD9AH</td>
<td>H.KEYI</td>
</tr>
</table>


<h2 title="4章 アプリケーションの開発">
Chapter 4: Application Development</h2>

<h3 title="4.1 アプリケーション開発についての注意点">
4.1 Notes regarding application development</h3>

<p title="MSX-MIDI対応のアプリケーションプログラムを作成するときは、以下の点に注意して下さい。">
When creating an application program that supports MSX-MIDI, please note the following points:</p>

<ol>
<li>
<p>
<span title="フックはMIDIが本体に内蔵されているか、外付けされているかで異なります。">
The hooks are different depending on whether MIDI is built-in or external.</span>
<span title="フックを設定する際は、内蔵タイプか外付けタイプかを確認して下さい。">
When setting up a hook, please check if the type is internal or external.</span>
</p>
</li>

<li>
<p title="MIDIインターフェイス初期化後などに割り込みを許可するときは、すでに割り込みフラグがセットされている可能性があるので、割り込みフラグをリセットしなければなりません。">
When enabling interrupts, such as after MIDI interface initialization, because there is a possibility that the interrupt flag has already been set, the interrupt flag must be reset.</p>

<p title="割り込みフラグには、以下ものがあります。">
Interrupt flags are as follows:</p>

<table>
<caption title="表 4.4 MIDIインターフェイスの割り込みフラグ">
Table 4.4 MIDI interface interrupt flags</caption>
<tr>
<th title="割り込みの種類">Interrupt type</th>
<th title="割り込みの判別">Interrupt distinction</th>
<th title="割り込みの解除方法">Interrupt clear method</th>
</tr>
<tr>
<td title="タイマー">Timer</td>
<td title="0E9Hまたは0E1Hのbit7(DSR)">Bit 7 (DSR) of 0E9H or 0E1H</td>
<td title="EAHへの任意の書き込み">Write any value to 0EAH</td>
</tr>
<tr>
<td title="MIDI IN">MIDI IN</td>
<td title="0E9Hまたは0E1Hのbit1(RRDY)">Bit 0 (RRDY) of 0E9H or 0E1H</td>
<td title="E8HをIN命令で読み込む">Read 0E8H with IN instruction</td>
</tr>
</table>
</li>

<li>
<p>
<span title="外付けカートリッジでは、MIDI INおよび8253タイマー以外の割り込みもH.KEYIに来ます。">
With the external cartridge, other interrupts besides MIDI IN and 8253 timer also come from H.KEYI.</span>
<span title="したがって、割り込み処理ルーチン内では、現在の割り込みがどういう割り込みなのか判別しなければなりません。">
Therefore, the interrupt handling routine must detect what kind of interrupt the current interrupt is.</span>
</p>

<p title="MIDI IN割り込みかどうかは、I/Oポート0E9H番地のbit1で確認します。">
Whether or not it is a MIDI IN interrupt can be checked in bit 1 of I/O port address 0E9H.</p>

<p title="8253タイマーからの割り込みかどうかは、I/Oボート0E9H番地のbit7で確認します。">
Whether or not it is an interrupt from the 8253 timer can be checked in bit 7 of I/O port address 0E9H.</p>
</li>

<li>
<p>
<span title="MIDI IN受信の割り込みは、最短320μ秒間隔で発生します。">
At the shortest, the MIDI IN receive interrupt occurs at 320 µs intervals.</span>
<span title="フックから割り込み処理ルーチンを呼ぶときにRST 30H命令を使うと、インタースロットコールの処理に時間がかかり、320µ秒間隔の受信に間に合わなくなります。">
When calling an interrupt handling routine from the hook with the RST 30H instruction, the inter-slot call takes time to process and will not complete in time for 320 µs interval reception.</span>
</p>

<p title="そのため、割り込みに関しては次のように設定して下さい。">
For that reason, set up interrupts as follows:</p>

<ul>
<li>
<p title="割り込み処理ルーチンはページ3に置く。">
Place the interrupt handling routine in page 3</p>
</li>

<li>
<p title="フックからはJP命令で割り込み処理ルーチンへジャンプする。">
Jump from the hook to the interrupt handling routine with the JP instruction</p>
</li>
</ul>

</li>
</ol>

<h3 title="4.2サンプルプログラム">
4.2 Sample program</h3>

<p title="MIDIインターフェイスとフックの設定•解除は、付属のサンプルプログラム (THRU.MAC) を参照して下さい。">
For MIDI interface and hook set up / tear down, please refer to the included <a href="thru.mac">sample program</a> (THRU.MAC).</p>


<h2 title="5章 拡張BASIC">
Chapter 5: BASIC Extensions</h2>

<p>TODO</p>


<p class="signed">Grauw</p>

<p><button type="button" onclick="var elements = document.querySelectorAll('*[title]'); for (var i = 0; i &lt; elements.length; i++) { var content = elements[i].textContent; elements[i].textContent = elements[i].title; elements[i].title = content; }">Switch language</button></p>

<?php addFooter(); ?>
</body>
</html>
