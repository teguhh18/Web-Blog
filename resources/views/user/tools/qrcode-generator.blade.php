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
                            <textarea class="textarea textarea-bordered w-full h-24" id="qrText" placeholder="Masukkan text atau URL yang ingin dijadikan QR Code..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Generate QR Code</button>
                    </form>
                    
                    <div id="qrResult" class="mt-6 hidden">
                        <div class="divider"></div>
                        <div class="text-center">
                            <h3 class="text-lg font-semibold mb-4">QR Code Result:</h3>
                            <div id="qrDisplay" class="mb-4 flex justify-center"></div>
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

<script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js"></script>
<script>
document.getElementById('qrForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const text = document.getElementById('qrText').value;
    
    if (text.trim() === '') {
        alert('Harap masukkan text atau URL');
        return;
    }
    
    const canvas = document.createElement('canvas');
    QRCode.toCanvas(canvas, text, function (error) {
        if (error) {
            console.error(error);
            alert('Error generating QR Code');
            return;
        }
        
        document.getElementById('qrDisplay').innerHTML = '';
        document.getElementById('qrDisplay').appendChild(canvas);
        document.getElementById('qrResult').classList.remove('hidden');
        
        // Setup download functionality
        document.getElementById('downloadBtn').onclick = function() {
            const link = document.createElement('a');
            link.download = 'qrcode.png';
            link.href = canvas.toDataURL();
            link.click();
        };
    });
});
</script>
@endsection