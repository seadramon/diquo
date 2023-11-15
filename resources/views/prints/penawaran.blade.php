<html>
    <head>
        <style>
            body {
                font-size: 11px;
            }

            .tengah {
                text-align: center;
                font-weight: bold;
            }

            .tebal {
                font-weight: bold;
            }

            .right {
                text-align: right;
            }

            .common {
                margin-bottom: 10px;
                font-size: 11px;
            }

            table.content {
                table-layout: auto; 
                width:100%;
                border-collapse: collapse;
            }

            .content table, .content th, .content td {
                border: 1px solid;
            }
            @page { margin: 92px 25px 10px 25px; }
            header { position: fixed; top: -80px; left: 0px; right: 0px; height: 50px; }

            table td, table td * {
                vertical-align: top;
            }

            #customers {
                font-size: 11px;
                border-collapse: collapse;
                width: 100%;
                margin-bottom: 5px;
            }

            #customers td, #customers th {
                border: 1px solid black;
                padding: 1px;
            }

            #customers th {
                padding-top: 1px;
                padding-bottom: 1px;
                background-color: #b0c4de;
            }

            ol  {
              margin-top: 0px;
              margin-bottom: 5px;
              padding-top: 0px;
              padding-bottom: 0px;
              margin-left: 25px;
              padding-left: 0px;
            }
        </style>
    </head>

    <body>
        <header>
            <table width="100%" style="border-bottom: 1px solid black;" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="75%" style="text-align: right;font-size: 15px;padding-right: 3px;font-weight: bold;color: #6699cc;font-family: Arial, Helvetica, sans-serif">
                        PT WIJAYA KARYA BETON Tbk
                    </td>
                    <td rowspan="2" width="25%" valign="top">
                        <img style="top: 0;width:100%;height:100%;" src="{{public_path('assets/media/logos/wikabeton2.jpg')}}">
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right;font-size: 15px;padding-right: 3px;font-weight: bold;font-family: Arial, Helvetica, sans-serif">WILAYAH PENJUALAN V</td>
                </tr>
            </table>

            <div style="text-align: right;margin-bottom: 2px;font-size: 10px;">
                Gedung Tamansari Papilio Lantai 5, Jl. Ahmad Yani No.176-178 Surabaya 60235, Telp : (031)99003395,99003396, Fax (031)99003384 ; email : wilayah5@wika-beton.co.id
            </div>
        </header>

        <main>
            <table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 5px;" class="common">
                <tr>
                    <td style="text-align: left;">Nomor : {{ $quotation->no_surat }}</td>
                    <td style="text-align: right;">Surabaya, {{ date("d M Y")}}</td>
                </tr>
            </table>

            <div  class="common">
                Kepada Yth : <br>
                <b>PT Wijaya Karya (Persero), Tbk</b> <br>
                <b>Divisi EPCC</b><br>
                Jl.D.I. Panjaitan Kav. 9-10
            </div>

            <table width="100%" class="common">
                <tr>
                    <td width="5%" style="text-align: right;font-weight: bold;">Up</td>
                    <td width="1%" style="text-align: right;font-weight: bold;">:</td>
                    <td width="94%" style="text-align: left;">Bapak Asep</td>
                </tr>
                <tr>
                    <td width="5%" style="text-align: right;font-weight: bold;">Telp</td>
                    <td width="1%" style="text-align: right;font-weight: bold;">:</td>
                    <td width="94%" style="text-align: left;">+ 62 853-3613-2114</td>
                </tr>
                <tr>
                    <td width="5%" style="text-align: right;font-weight: bold;">Perihal</td>
                    <td width="1%" style="text-align: right;font-weight: bold;">:</td>
                    <td width="94%" style="text-align: left;">Penawaran Harga Tiang Pancang Kotak Wika Beton</td>
                </tr>
            </table>

            <div style="font-size: 11px;margin-bottom: 5px;">
                Dengan hormat,<br>
                Menindaklanjuti permintaan Bapak mengenai Penawaran Harga Tiang Pancang Kotak untuk Proyek Area {{ $quotation->lokasi_proyek }} dan Sekitarnya, berikut kami sampaikan dengan rincian sebagai berikut:
            </div>

            <div style="margin-bottom: 20px;">
                <b>A. Harga Tiang Pancang</b><br>
                <table id="customers" width="100%" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th rowspan="3">No.</th>
                            <th rowspan="2">DIMENSI</th>
                            <th rowspan="3">KELAS</th>
                            <th rowspan="2">PJG</th>
                            <th rowspan="3">SEGMEN</th>
                            <th colspan="3">KAPASITAS</th>
                            <th rowspan="2">HARGA SATUAN</th>
                        </tr>
                        <tr>
                            <th>CRACK</th>
                            <th>BREAK</th>
                            <th>AXIAL</th>
                        </tr>
                        <tr>
                            <th>(mm)</th>
                            <th>(m')</th>
                            <th>(ton.m)</th>
                            <th>(ton.m)</th>
                            <th>(ton.m)</th>
                            <th>(Rp/m')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($quotation->produk as $index => $produk)
                            @php
                                $tipe = explode(' ',explode(' - ', $produk->tipe_produk)[1]);
                                $segmen = "Bottom";
                                if($tipe[2] == "M"){
                                    $segmen = "Middle";
                                }elseif($tipe[2] == "U"){
                                    $segmen = "Upper";
                                }
                            @endphp
                            <tr style="text-align: center">
                                <td>{{$index+1}}.</td>
                                <td>Dia {{ $tipe[0] * 10 }}</td>
                                <td>{{ $tipe[1] }}</td>
                                <td>{{ $produk->panjang }}</td>
                                <td>{{ $segmen }}</td>
                                <td>{{ $produk->produk->cap_crack ?? '-'}}</td>
                                <td>{{ $produk->produk->cap_break ?? '-'}}</td>
                                <td>{{ $produk->produk->cap_axial ?? '-'}}</td>
                                <td>{{ number_format($produk->hju) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <b>B. Kondisi Harga</b>
                <ol>
                    <li>Harga tersebut Belum termasuk PPN 11%.</li>
                    <li>Kondisi pengiriman <strong>{{ strtoupper($quotation->kondisi_pengiriman) }} Lokasi Proyek di {{ $quotation->lokasi_proyek }},</strong> dengan kondisi aman dilalui oleh Trailer dengan muatan 40 ton/rit. Tidak termasuk langsir jika jalan tidak bisa dilalui Trailer.</li>
                    <li>Tiang Pancang Kotak sudah termasuk Asesoris Bottom (Sepatu Pensil + Plat Sambung) atau Single (Sepatu Pensil + Kepala Masif).</li>
                    <li><strong>Tidak</strong> termasuk pengadaan kayu ganjal untuk penumpukan, biaya penurunan tiang pancang di lokasi proyek.</li>
                    <li><strong>Tidak</strong> termasuk biaya maupun kewajiban administrasi yang timbul untuk memasuki area proyek.</li>
                    <li><strong>Tidak</strong> termasuk biaya pengetesan diluar pabrik (test independent).</li>
                </ol>

                <b>C. Cara Pembayaran</b>
                <ol>
                    <li>DP 30% dibayarkan bersamaan dengan penandatanganan kontrak dan sebelum barang diproduksi.</li>
                    <li>Pembayaran kedua sebesar 70% sesuai progress pengiriman.</li>
                </ol>

                <b>D. Spesifikasi Teknik dan Jadwal Produksi</b>
                <ol>
                    <li>Mutu beton Tiang Pancang Kotak Semen Type I, fc' = 42 MPa dan spesifikasi lainnya sesuai dengan standar produk WIKA Beton. (Gambar terlampir)</li>
                    <li>Spiral Wire menggunakan tipe/jenis SWMP dengan tensile strength = 540 Mpa</li>
                    <li>Produksi dimulai ±1 minggu setelah penerbitan PO dan pembayaran uang muka</li>
                </ol>

                <b>E. Lain-lain</b>
                <ol>
                    <li>Mutu produk dijamin dengan sertifikasi sistem manajemen <strong>ISO 9001 : 2015 dan SNI 6880 : 2016.</strong></li>
                    <li>Penawaran berlaku selama 14 (Empat Belas) hari, terhitung sejak tanggal surat diatas, dan atau selama tidak ada perubahan kebijakan dari pemerintah menyangkut moneter, kenaikan harga BBM, kenaikan tarif dasar listrik (TDL) dan Lain - Lain.</li>
                </ol><br>

                Demikian penawaran kami, untuk informasi dan negosiasi lebih lanjut dapat menghubungi kantor kami - 031.99003395-96 dengan <strong>Sdr. Holidin Arif - 0852 2480 7485 atau Firman Pambudi - 0813 2928 2724.</strong> Atas perhatiannya kami ucapkan terima kasih.
            </div>

            <table width="100%">
                <tr>
                    <td width="70%">&nbsp;</td>
                    <td width="30%">
                        Hormat Kami,<br>
                        PT WIJAYA KARYA BETON Tbk<br>
                        Wilayah Penjualan V<br>
                        <img style="text-align: center;width:95%;height:auto;" src="{{public_path('assets/media/logos/signature.jpg')}}">
                        <u><b>ZAENUDIN SAKTI WIBOWO</b></u><br>
                        Manajer
                    </td>
                </tr>
            </table>
        </main>
    </body>
</html>