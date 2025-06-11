<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSystem - My Trains</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/css/MyTrains.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div id="container" class="tw:min-h-screen tw:bg-cover tw:bg-center tw:bg-no-repeat tw:fixed tw:inset-0">
        <x-navbar />
        <div id="boxContainer" class="tw:h-full tw:w-full tw:flex tw:justify-center tw:items-center tw:pt-20">
            <div class="box tw:w-10/12 md:tw:w-8/12 tw:h-auto tw:min-h-[70vh] tw:bg-gray-200 tw:bg-opacity-80 tw:rounded-lg tw:p-6 tw:shadow-lg tw:flex tw:flex-col">

                <!-- Tabla de trenes -->
                <div class="tw:overflow-x-auto tw:flex-grow">
                    <table class="tw:min-w-full tw:bg-gray-300 tw:rounded-lg tw:shadow-md tw:overflow-hidden">
                        <thead class="tw:bg-gray-400 tw:text-gray-800 tw:uppercase tw:text-sm tw:leading-normal">
                            <tr>
                                <th class="tw:py-3 tw:px-6 tw:text-left">Status</th>
                                <th class="tw:py-3 tw:px-6 tw:text-left">Travel Code</th>
                                <th class="tw:py-3 tw:px-6 tw:text-left">Origin</th>
                                <th class="tw:py-3 tw:px-6 tw:text-left">Destiny</th>
                                <th class="tw:py-3 tw:px-6 tw:text-left">Departure</th>
                                <th class="tw:py-3 tw:px-6 tw:text-left">View More</th>
                                <th class="tw:py-3 tw:px-6 tw:text-left">Edit</th>
                            </tr>
                        </thead>

                        <tbody class="tw:text-gray-900 tw:text-sm tw:font-light">
                            @foreach($travels as $travel)
                            <tr class="tw:border-b tw:border-gray-200 hover:tw:bg-gray-100 tw:font-bold">
                                <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">
                                    @if($travel->status)
                                        <span class="tw-text-green-600">Active</span>
                                    @else
                                        <span class="tw-text-red-600">Inactive</span>
                                    @endif
                                </td>
                                <td style="font-size:10px;" class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">{{ $travel->travelCode }}</td>
                                <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">{{ $travel->origin }}</td>
                                <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">{{ $travel->destiny }}</td>
                                <td class="tw:py-3 tw:px-6 tw:text-left whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($travel->departureDay)->format('d/m/Y') }} at {{ $travel->departureHour }}
                                </td>
                                <td class="tw:text-center">
                                    <button type="button"                                        class="tw:text-black tw:font-bold tw:py-2 tw:px-4 tw:rounded tw:inline-flex tw:items-center">
                                        <i class="fa-solid fa-eye" style="color: #000000;"></i>
                                    </button>
                                </td>
                                <td class="tw:text-center">
                                    <button type="button"                                         class="tw:text-black tw:font-bold tw:py-2 tw:px-4 tw:rounded tw:inline-flex tw:items-center">
                                        <i class="fa-solid fa-pen-to-square" style="color: #000000;"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</body>
</html>
