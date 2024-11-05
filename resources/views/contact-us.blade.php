

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.neutral-100">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="bg-zinc-800 px-6 py-10 lg:py-15 lg:px-8">
  <div class="mx-auto max-w-2xl text-center">
    <h2 class="text-balance text-4xl tracking-tight text-white lg:text-5xl">Contact Us</h2>
    <p class="mt-2 text-lg/8 text-violet-700">Enter details below</p>
  </div>
  <form action="{{ route('development.send') }}" method="POST" class="mx-auto mt-10 max-w-lg lg:mt-10">
    @csrf
    <div class="grid grid-cols-1 gap-x-8 gap-y-5 lg:grid-cols-2">
      <div>
        <label for="first-name" class="block text-lg/6 text-white text-sm">First name</label>
        <div class="mt-2.5">
          <input type="text" name="first-name" id="first-name" class="block w-full rounded-lg border border-neutral-100 px-3.5 py-2 text-white bg-zinc-700" required>
        </div>
      </div>
      <div>
        <label for="last-name" class="block text-lg/6 text-white text-sm">Last name</label>
        <div class="mt-2.5">
          <input type="text" name="last-name" id="last-name" class="block w-full rounded-lg border border-neutral-100 px-3.5 py-2 text-white bg-zinc-700" required>
        </div>
      </div>
      <div class="lg:col-span-2">
        <label for="email" class="block text-lg/6 text-white text-sm">Email</label>
        <div class="mt-2.5">
          <input type="email" name="email" id="email" class="block w-full rounded-lg border border-neutral-100 px-3.5 py-2 text-white bg-zinc-700" required>
        </div>
      </div>
      <div class="lg:col-span-2">
        <label for="subject" class="block text-lg/6 text-white text-sm">Subject</label>
        <div class="mt-2.5">
          <input type="text" name="subject" id="subject" class="block w-full rounded-lg border border-neutral-100 px-3.5 py-2 text-white bg-zinc-700">
        </div>
      </div>
      <div class="lg:col-span-2">
        <label for="message" class="block text-lg/6 text-white text-sm">Message</label>
        <div class="mt-2.5">
          <textarea name="message" id="message" rows="4" class="block w-full rounded-lg border border-neutral-100 px-3.5 py-2 text-white placeholder:text-white-400 bg-zinc-700" minlength="10" required></textarea>
        </div>
      </div>
    </div>
    <div class="mt-10">
      <button type="submit" name="submit" class="block w-full rounded-lg bg-violet-700 px-3.5 py-2.5 text-center text-base text-white hover:bg-violet-500"  onClick="msgSent()">Submit</button>
    </div>
  </form>
  <div id="sentPopup" class="hidden p-4 mt-1 mb-4 text-md text-green-400 rounded-md bg-gray-700">
    <p>Message sent!</p>
  </div>
  <script>
    function msgSent() {
      document.getElementById("sentPopup").classList.remove('hidden');
    }
  </script>
</div>

    
</body>
</html>