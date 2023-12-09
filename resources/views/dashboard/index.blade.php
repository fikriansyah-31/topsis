@extends('dashboard.layouts.app')

@section('container')
    <!-- row 1 -->
    <div class="flex flex-wrap -mx-3">
        <!-- card1 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-semibold leading-normal text-sm">Kriteria</p>
                                <h5 class="mb-0 font-bold">
                                    {{ $jml_kriteria }}
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="flex justify-center items-center w-12 h-12 rounded-lg bg-gradient-to-tl from-backgroundSecondary to-greenSecondary">
                                <i class="ri-table-fill text-2xl text-greenPrimary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card2 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-semibold leading-normal text-sm">Sub Kriteria</p>
                                <h5 class="mb-0 font-bold">
                                    {{ $subKriteria }}
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="flex justify-center items-center w-12 h-12 rounded-lg bg-gradient-to-tl from-backgroundSecondary to-greenSecondary">
                                <i class="ri-collage-fill text-2xl text-greenPrimary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card3 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-semibold leading-normal text-sm">Objek</p>
                                <h5 class="mb-0 font-bold">
                                    {{ $objek }}
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="flex justify-center items-center w-12 h-12 rounded-lg bg-gradient-to-tl from-backgroundSecondary to-greenSecondary">
                                <i class="ri-brackets-fill text-2xl text-greenPrimary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card4 -->
        <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-semibold leading-normal text-sm">Alternatif</p>
                                <h5 class="mb-0 font-bold">
                                    {{ $alternatif }}
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="flex justify-center items-center w-12 h-12 rounded-lg bg-gradient-to-tl from-backgroundSecondary to-greenSecondary">
                                <i class="ri-braces-fill text-2xl text-greenPrimary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- cards row 2 -->
    <div class="flex flex-wrap mt-6 -mx-3">
        <div class="w-full px-3 mb-6 lg:mb-0 lg:w-7/12 lg:flex-none">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap -mx-3">
                        <div class="max-w-full px-3 lg:w-1/2 lg:flex-none">
                            <div class="flex flex-col h-full">
                                <h5 class="font-bold">SPK Seleksi Calon Teknisi IT </h5>
                                <p class="mb-12 text-justify">Aplikasi SPK ini merupakan aplikasi pembantu pengambilan keputusan dengan 2 metode yaitu metode Topsis dan Profile Matching yang memiliki cara hitung yang berbeda dan memberikan solusi ideal dari hasil hitung kedua metode tersebut.</p>
                            </div>
                        </div>
                        <div class="max-w-full px-3 mt-12 ml-auto text-center lg:mt-0 lg:w-5/12 lg:flex-none">
                            <div class="h-full bg-gradient-to-tl from-backgroundSecondary to-greenSecondary rounded-xl">
                                <img src="{{ asset('img/shapes/waves-white.svg') }}" class="absolute top-0 hidden w-1/2 h-full lg:block" alt="waves" />
                                <div class="relative flex items-center justify-center h-full">
                                    <img class="relative z-20 w-full pt-6" src="{{ asset('img/illustrations/rocket-white.png') }}" alt="rocket" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full max-w-full px-3 lg:w-5/12 lg:flex-none">
            <div
                class="border-black/12.5 shadow-soft-xl relative flex h-full min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border p-4">
                <div class="relative h-full overflow-hidden bg-cover rounded-xl" style="background-image: url('{{ asset('img/alena-aenami-rooflinesgirl.jpg') }}')">
                    <span class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-gray-900 to-slate-800 opacity-80"></span>
                    <div class="relative z-10 flex flex-col flex-auto h-full p-4">
                        <h5 class="pt-2 mb-6 font-bold text-white">Kegunaan TOPSIS dan Profile Matching </h5>
                        <ul class="ml-3 text-white" style="list-style-type: square;">
                            <li>Komputasi yang efisien.</li>
                            <li>kemampuan untuk mengukur kinerja relatif dari alternatif-alternatif keputusan dalam bentuk sederhana. Dapat digunakan metode pengambilan keputusan yang lebih cepat. </li>
                            <li>Pemetaan Gap Profile pada perhitungan Profile Matching untuk pengelompokan Core Factor dan Secondary Factor.</li>
                            <li>Memberikan hasil perbandingan dari 2 metode perhitungan sebagai nilai pembanding dari kriteria yang sudah ditentukan.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
