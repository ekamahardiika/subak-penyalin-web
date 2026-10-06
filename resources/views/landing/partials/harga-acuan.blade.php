@if ($hargaApi && !empty($hargaApi['items']))

    <div class="flex flex-wrap justify-center gap-6">

        @foreach ($hargaApi['items'] as $item)
            <div class="rounded-3xl border border-gray-200 bg-gray-50 p-6 text-center">

                <p class="text-sm text-gray-500 font-semibold">
                    {{ $item['nama'] }}
                </p>

                <p class="text-2xl md:text-3xl font-black text-green-700 mt-2">
                    Rp {{ number_format($item['harga'], 0, ',', '.') }}
                </p>

                <p class="text-xs text-gray-400">
                    per kg
                </p>

                @if ($item['selisih'] > 0)
                    <p class="text-xs font-semibold text-red-600 mt-3">
                        <span class="inline-flex items-center gap-1">
                            <i class="fa-solid fa-arrow-trend-up"></i>

                            Naik
                        </span>

                        Rp {{ number_format($item['selisih'], 0, ',', '.') }}

                        <span>
                            ({{ number_format($item['persen'], 2, ',', '.') }}%)
                        </span>
                    </p>
                @elseif ($item['selisih'] < 0)
                    <p class="text-xs font-semibold text-green-600 mt-3">

                        <span class="inline-flex items-center gap-1">
                            <i class="fa-solid fa-arrow-trend-down"></i>

                            Turun
                        </span>

                        Rp {{ number_format(abs($item['selisih']), 0, ',', '.') }}

                        <span>
                            ({{ number_format(abs($item['persen']), 2, ',', '.') }}%)
                        </span>

                    </p>
                @else
                    <p class="text-xs text-gray-400 mt-3">
                        <span class="inline-flex items-center gap-1">
                            <i class="fa-solid fa-minus"></i>
                            Stabil
                        </span>
                    </p>
                @endif

            </div>
        @endforeach

    </div>

    <p class="text-xs text-gray-400 text-center mt-6">

        Sumber: SIGAPURA Pemprov Bali · Per

        {{ \Illuminate\Support\Carbon::parse($hargaApi['tanggal'])->translatedFormat('d F Y') }}

        · Perubahan dibanding 7 hari terakhir

    </p>
@elseif ($hargaTerbaru)
    <div class="rounded-3xl border border-gray-200 bg-gray-50 p-8 text-center max-w-md mx-auto">

        <p class="text-sm text-gray-500 font-semibold">
            {{ $hargaTerbaru->sumber_label }}
        </p>

        <p class="text-4xl font-black text-green-700 mt-2">

            Rp {{ number_format($hargaTerbaru->harga_gabah, 0, ',', '.') }}

            <span class="text-base text-gray-500">
                /kg
            </span>

        </p>

        <p class="text-xs text-gray-400 mt-3">

            {{ \Illuminate\Support\Carbon::parse($hargaTerbaru->tanggal)->translatedFormat('d F Y') }}

        </p>

    </div>
@else
    <p class="text-center text-gray-500 text-sm">
        Data harga belum tersedia.
    </p>

@endif
