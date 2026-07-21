<!DOCTYPE html>
<html lang="id">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>
@yield('title') | Bakso Pakde Heru
</title>


@vite(['resources/css/app.css','resources/js/app.js'])


<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">


<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


<style>

body{
font-family:'Poppins',sans-serif;
}

</style>


</head>


<body class="bg-[#f8f5f2]">


<div class="flex min-h-screen">


<!-- SIDEBAR -->

<aside class="w-64 bg-[#333333] text-white">


<div class="p-6">


<h1 class="text-xl font-bold text-red-500">

🍜 Bakso Pakde Heru

</h1>


<p class="text-xs text-gray-400">
Admin Panel
</p>


</div>




<nav class="mt-5">


<a class="flex gap-3 px-6 py-3 bg-white text-red-600 rounded-r-full">

<i class="fa fa-home"></i>

Dashboard

</a>



<a class="flex gap-3 px-6 py-3 hover:bg-gray-700">

<i class="fa fa-bowl-food"></i>

Kelola Menu

</a>



<a class="flex gap-3 px-6 py-3 hover:bg-gray-700">

<i class="fa fa-layer-group"></i>

Kategori

</a>



<a class="flex gap-3 px-6 py-3 hover:bg-gray-700">

<i class="fa fa-cart-shopping"></i>

Pesanan

</a>



<a class="flex gap-3 px-6 py-3 hover:bg-gray-700">

<i class="fa fa-chart-line"></i>

Laporan

</a>


</nav>


</aside>




<!-- CONTENT -->

<main class="flex-1">


<header class="bg-white px-8 py-5 flex justify-between shadow-sm">


<div>

<h2 class="font-bold text-xl">

@yield('title')

</h2>


<p class="text-gray-400 text-sm">

Bakso Pakde Heru

</p>


</div>


<div>

<img src="https://ui-avatars.com/api/?name=Admin"
class="rounded-full w-12">

</div>


</header>



<section class="p-8">

@yield('content')

</section>



</main>


</div>


</body>

</html>
