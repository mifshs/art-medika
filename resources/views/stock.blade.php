<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Акции</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('components.header')
    <div class="w-full gap-6 px-4 lg:px-10">
        <div class="flex gap-4 text-lg text-[#37241B]">
            <a href="../">
                Арт-Медика
            </a>
            <img src="{{ asset('images/_.svg') }}" alt="стрелка">
            <p class="font-[500]">
                Проекты
            </p>
        </div>
        
        <div class="flex items-start justify-between pt-[40px]">
            <h1 class="text-[#91B5D5] font-[500] text-[40px] flex items-center gap-2">
                Проекты
                <img src="{{asset('images/Arrow_right_light.svg')}}" alt="стрелка" class="w-[50px]">
            </h1>
            <p class="text-[40px] text-[#1D293D] w-[1140px] font-medium">
                Подбираем для вас самые актуальные <br> и интересные проекты из нашей практики, медицины <br> и эстетической хирургии, с заботой о вас
            </p>
        </div>
    </div>
</body>
</html>
