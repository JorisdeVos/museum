@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <canvas id="paintCanvas" width="800" height="600" class="border-8 border-gold mb-4"></canvas>
            <div class="flex justify-center space-x-2 mb-4">
                <!-- Color buttons -->
                <button class="color-btn w-10 h-10 rounded-full border-2 border-white" style="background-color: #000000;"></button>
                <button class="color-btn w-10 h-10 rounded-full border-2 border-white" style="background-color: #ffffff;"></button>
                <button class="color-btn w-10 h-10 rounded-full border-2 border-white" style="background-color: #ff0000;"></button>
                <button class="color-btn w-10 h-10 rounded-full border-2 border-white" style="background-color: #00ff00;"></button>
                <button class="color-btn w-10 h-10 rounded-full border-2 border-white" style="background-color: #0000ff;"></button>
                <button class="color-btn w-10 h-10 rounded-full border-2 border-white" style="background-color: #ffff00;"></button>
                <button class="color-btn w-10 h-10 rounded-full border-2 border-white" style="background-color: #ff00ff;"></button>
                <button class="color-btn w-10 h-10 rounded-full border-2 border-white" style="background-color: #00ffff;"></button>
                <button class="color-btn w-10 h-10 rounded-full border-2 border-white" style="background-color: #800000;"></button>
                <button class="color-btn w-10 h-10 rounded-full border-2 border-white" style="background-color: #008000;"></button>
                <button class="color-btn w-10 h-10 rounded-full border-2 border-white" style="background-color: #000080;"></button>
                <button class="color-btn w-10 h-10 rounded-full border-2 border-white" style="background-color: #808000;"></button>
                <button class="color-btn w-10 h-10 rounded-full border-2 border-white" style="background-color: #800080;"></button>
                <button class="color-btn w-10 h-10 rounded-full border-2 border-white" style="background-color: #008080;"></button>
                <button class="color-btn w-10 h-10 rounded-full border-2 border-white" style="background-color: #808080;"></button>
                <button class="color-btn w-10 h-10 rounded-full border-2 border-white" style="background-color: #c0c0c0;"></button>
            </div>
            <button id="submitBtn" class="bg-green-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-green-600">Submit Painting</button>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const canvas = document.getElementById('paintCanvas');
        const ctx = canvas.getContext('2d');
        let isDrawing = false;
        let lastX = 0;
        let lastY = 0;
        let color = '#000000'; // Default color

        // Function to draw on canvas
        function draw(e) {
            if (!isDrawing) return;
            ctx.strokeStyle = color;
            ctx.lineCap = 'round';
            ctx.lineWidth = 5;
            ctx.beginPath();
            ctx.moveTo(lastX, lastY);
            ctx.lineTo(e.offsetX, e.offsetY);
            ctx.stroke();
            [lastX, lastY] = [e.offsetX, e.offsetY];
        }

        // Event listeners for mouse down, move, and up
        canvas.addEventListener('mousedown', (e) => {
            isDrawing = true;
            [lastX, lastY] = [e.offsetX, e.offsetY];
        });

        canvas.addEventListener('mousemove', (e) => {
            if (isDrawing) {
                draw(e);
            }
        });

        canvas.addEventListener('mouseup', () => isDrawing = false);

        // Event listener for color buttons
        document.querySelectorAll('.color-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                color = btn.style.backgroundColor;
            });
        });

        // Event listener for submit button
        document.getElementById('submitBtn').addEventListener('click', () => {
        const imageData = canvas.toDataURL();
        // Send imageData to server
        saveImage(imageData);
    });

    // Function to save image data to public storage
    function saveImage(imageData) {
        fetch('/save-image', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ image: imageData }) // Change 'imageData' to 'image'
        })
        .then(response => {
            if (response.ok) {
                console.log('Image saved successfully!');
            } else {
                console.error('Failed to save image:', response.statusText);
            }
        })
        .catch(error => {
            console.error('Error saving image:', error);
        });
    }
    </script>
@endsection


