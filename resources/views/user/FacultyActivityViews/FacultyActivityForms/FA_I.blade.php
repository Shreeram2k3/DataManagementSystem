@extends('layouts.navbar')

@section('content')

<section class="flex flex-col lg:flex-row min-h-screen">
  <div class="w-full lg:w-1/2 flex items-center justify-center p-4 ">
    <div id="lottie-animation" class="w-full h-full sm:h-[500px] lg:h-[600px]"></div>
  </div>

  <!-- Lottie Script -->
  <script src="https://unpkg.com/lottie-web@5.10.2/build/player/lottie.min.js"></script>
  <script>
    const anim = lottie.loadAnimation({
      container: document.getElementById('lottie-animation'),
      path: '{{ asset("Office Work.json") }}',
      renderer: 'svg',
      loop: true,
      autoplay: false
    });

    anim.addEventListener('data_ready', () => {
      const fps = anim.frameRate;
      const startFrame = Math.floor(2 * fps);  // 2 second mark
      const endFrame = anim.totalFrames;       // till the end
      anim.playSegments([startFrame, endFrame], true);
    });
  </script>

  <main class="w-full lg:w-1/2 bg-white px-6 py-8 sm:px-10 lg:px-20 flex items-center justify-center">
    <form action="">
      name:   <input type="text"><br><br>
      class:  <input type="text"> <br><br>
      roll no: <input type="text"> <br><br>
      state <input type="text"> <br><br>
      <button>check</button>
    </form>
  </main>
</section>

@endsection
