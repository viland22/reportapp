@extends('layouts.dashboard')
@section('title', 'View Report All Activity')

@section('content')
    <div class="card">
        <div class="card-header pb-0">
            <h5 class="card-title">View Report All Activity</h5>
        </div>
        <hr />
        <div class="card-body">
            <div class="row">
                <div class="bg-lighter rounded p-4 mb-6 position-relative">
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 200px">Activity Id</td>
                                <td style="width: 20px">:</td>
                                <td>{{ $data->ActivityId }}</td>
                            </tr>
                            <tr>
                                <td style="width: 200px">Activity Name</td>
                                <td style="width: 20px">:</td>
                                <td>{{ $data->ActivityName }}</td>
                            </tr>
                            <tr>
                                <td style="width: 200px">Wo Number</td>
                                <td style="width: 20px">:</td>
                                <td>{{ $data->wo_number->wo_number }}</td>
                            </tr>
                            <tr>
                                <td style="width: 200px">Department</td>
                                <td style="width: 20px">:</td>
                                <td>{{ $data->department->initial }} - {{ $data->department->name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bg-lighter rounded p-4 mb-6 position-relative">
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 200px">BL Project Start</td>
                                <td style="width: 20px">:</td>
                                <td>{{ \Carbon\Carbon::parse($data->BLProjectStart)->format('d-M-y') }}
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 200px">BL Project Finish</td>
                                <td style="width: 20px">:</td>
                                <td>{{ \Carbon\Carbon::parse($data->BLProjectFinish)->format('d-M-y') }}
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 200px">BL Holiday</td>
                                <td style="width: 20px">:</td>
                                <td>{{ $data->BLHoliday }}</td>
                            </tr>
                            <tr>
                                <td style="width: 200px">BL Duration</td>
                                <td style="width: 20px">:</td>
                                <td>{{ $data->BLDuration }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bg-lighter rounded p-4 mb-6 position-relative">
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 200px">Actual Start</td>
                                <td style="width: 20px">:</td>
                                <td>
                                    {{ $data->ActualStart ? \Carbon\Carbon::parse($data->ActualStart)->format('d-M-y') : '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 200px" style="vertical-align: top;">Remark Start</td>
                                <td style="width: 10px" style="vertical-align: top;">:</td>
                                <td style="vertical-align: top;">
                                    {{ trim($data->RemarkStart) }}
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 200px">Actual Finish</td>
                                <td style="width: 20px">:</td>
                                <td style="vertical-align: top;">
                                    {{ $data->ActualFinish ? \Carbon\Carbon::parse($data->ActualFinish)->format('d-M-y') : '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 200px" style="vertical-align: top;">Remark Finish</td>
                                <td style="width: 10px" style="vertical-align: top;">:</td>
                                <td style="vertical-align: top;">
                                    {{ $data->RemarkFinish }}</td>
                            </tr>

                            <tr>
                                <td style="width: 200px">Actual Holiday</td>
                                <td style="width: 20px">:</td>
                                <td>{{ $data->ActualHoliday }}</td>
                            </tr>
                            <tr>
                                <td style="width: 200px">Actual Duration</td>
                                <td style="width: 20px">:</td>
                                <td>{{ $data->ActualDuration }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bg-lighter rounded p-4 mb-6 position-relative">
                    <h5 class="card-title mb-7 me-2">Progress</h5>
                    @if ($progress->isEmpty())
                        <p class="text-body-secondary">No progress updates available.</p>
                    @else
                        <ul class="timeline mb-0">
                            @foreach ($progress as $progressdata)
                                <li class="timeline-item timeline-item-transparent" style="{{ $loop->last ? 'border-inline: none;' : '' }}">
                                    <span
                                        class="timeline-point timeline-point-{{ $progressdata->ProgressPercent == 0 ? 'danger' : ($progressdata->ProgressPercent == 100 ? 'success' : 'warning') }}"></span>
                                    <div class="timeline-event">
                                        <div class="d-flex mb-1">
                                            <h6 class="mb-0 me-4">{{ $progressdata->ProgressPercent }}%</h6>
                                            <h6 class="mb-0 text-secondary">
                                                {{ \Carbon\Carbon::parse($progressdata->ProgressDate)->format('d-M-y') }}
                                            </h6>
                                        </div>
                                        <p class="mb-5">{{ $progressdata->ProgressNote }}</p>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    @endif

                </div>
                <div class="bg-lighter rounded p-4 position-relative">
                    @if ($images->isEmpty())
                        <div class="bg-lighter rounded p-4 position-relative mb-2">
                            <p>No images uploaded for this workshop.</p>
                        </div>
                    @endif
                    <div class="row">
                        @foreach ($images as $imagesdata)
                            <div class="col-4 col-md-2 mb-4">
                                <div class="bg-light rounded overflow-hidden" style="aspect-ratio: 1/1; cursor: pointer;">
                                    <img src="{{ asset('storage/workshop/' . $imagesdata->Filename) }}"
                                        alt="Workshop Image" class="img-fluid gallery-image"
                                        style="width: 100%; height: 100%; object-fit: cover;"
                                        data-src="{{ asset('storage/workshop/' . $imagesdata->Filename) }}">
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Popup overlay --}}
                    <div id="imagePopup" class="popup-overlay d-none">
                        <span class="popup-close">&times;</span>
                        <img class="popup-content" id="popupImage" src="">
                    </div>

                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <a href="{{ route('page.report.allactivity.index') }}" class="btn btn-dark"><i
                    class="icon-base bx bx-arrow-back icon-sm me-1"></i> Back to list</a>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('.gallery-image');
            const popup = document.getElementById('imagePopup');
            const popupImg = document.getElementById('popupImage');
            const popupClose = document.querySelector('.popup-close');

            images.forEach(img => {
                img.addEventListener('click', function() {
                    popupImg.src = this.dataset.src;
                    popup.classList.remove('d-none');
                });
            });

            popupClose.addEventListener('click', function() {
                popup.classList.add('d-none');
                popupImg.src = '';
            });

            popup.addEventListener('click', function(e) {
                if (e.target === popup) {
                    popup.classList.add('d-none');
                    popupImg.src = '';
                }
            });
        });
    </script>
@endsection
