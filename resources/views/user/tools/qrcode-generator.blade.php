@extends('user.new-layouts.main')
@section('main')
    <div class="container mx-auto py-8 px-4">
        <div class="flex justify-center">
            <div class="w-full max-w-2xl">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h2 class="card-title text-2xl font-bold mb-6">QR Code Generator</h2>

                        <form id="qrForm">
                            <div class="form-control w-full mb-4">
                                <label class="label" for="qrText">
                                    <span class="label-text text-base font-medium">Masukkan Text atau URL</span>
                                </label>
                                <textarea class="textarea textarea-bordered w-full h-24" id="qrText"
                                    placeholder="Masukkan text atau URL yang ingin dijadikan QR Code..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Generate QR Code</button>
                        </form>

                        <div id="qrResult" class="mt-6 hidden">
                            <div class="divider"></div>
                            <div class="text-center">
                                <h3 class="text-lg font-semibold mb-4">QR Code Result:</h3>
                                <div id="qrDisplay" class="mb-4 flex justify-center">

                                </div>
                                <button id="downloadBtn" class="btn btn-success">
                                    <i class="fas fa-download"></i> Download QR Code
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            $(document).ready(function() {
                $('#qrForm').on('submit', function(e) {
                    e.preventDefault();
                    const qrText = $('#qrText').val();

                    if (qrText === '') {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Please enter text or URL to generate QR Code.',
                            icon: 'error',
                        });
                        return;
                    }

                    $('#qrDisplay').empty();
                    $('#qrResult').addClass('hidden');

                    $.get("{{ route('user.tools.qrcode') }}", {
                        text: qrText
                    }, function(res) {
                        if (res.status === 'success') {
                            $('#qrDisplay').append(res.data)
                            $('#qrResult').removeClass('hidden');


                            Swal.fire({
                                title: 'Success!',
                                text: 'Generate QR Code Berhasil',
                                icon: 'success',
                            })
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: res.message,
                                icon: 'error',
                            })
                        }
                    });

                });

                $('#downloadBtn').on('click', function() {
                    const svg = $('#qrDisplay svg')[0];
                    if (!svg) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'No QR Code to download.',
                            icon: 'error',
                        });
                        return;
                    }

                    const svgData = new XMLSerializer().serializeToString(svg);
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');
                    const img = new Image();

                    // Set canvas size to match SVG size
                    const svgSize = svg.getBoundingClientRect();
                    canvas.width = svgSize.width;
                    canvas.height = svgSize.height;

                    img.onload = function() {
                        // Draw the SVG image onto the canvas
                        ctx.drawImage(img, 0, 0);
                        URL.revokeObjectURL(img.src); // Clean up the blob URL

                        // Create a download link for the PNG
                        const a = document.createElement('a');
                        a.href = canvas.toDataURL('image/png');
                        a.download = 'qrcode.png';
                        document.body.appendChild(a);
                        a.click();
                        document.body.removeChild(a);
                    };

                    // Create a Blob from the SVG data and set it as the image source
                    const blob = new Blob([svgData], {
                        type: 'image/svg+xml;charset=utf-8'
                    });
                    img.src = URL.createObjectURL(blob);
                });
            });
        </script>
    @endpush
@endsection
