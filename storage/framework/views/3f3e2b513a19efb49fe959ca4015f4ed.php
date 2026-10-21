<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Акции</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body>
    <?php echo $__env->make('components.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <div class="w-full gap-6 px-4 lg:px-10">
        <div class="flex gap-4 text-lg text-[#37241B]">
            <a href="../">
                Арт-Медика
            </a>
            <img src="<?php echo e(asset('images/_.svg')); ?>" alt="стрелка">
            <p class="font-[500]">
                Проекты
            </p>
        </div>
        
        <div class="flex items-start justify-between pt-[40px]">
            <h1 class="text-[#91B5D5] font-[500] text-[40px] flex items-center gap-2">
                Проекты
                <img src="<?php echo e(asset('images/Arrow_right_light.svg')); ?>" alt="стрелка" class="w-[50px]">
            </h1>
            <p class="text-[40px] text-[#1D293D] w-[1140px] font-medium">
                Подбираем для вас самые актуальные <br> и интересные проекты из нашей практики, медицины <br> и эстетической хирургии, с заботой о вас
            </p>
        </div>
    </div>
    <div class="lg:px-10 mt-[40px]">
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('stock.project-list', []);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-4058899952-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    </div>
</body>
</html>
<?php /**PATH D:\xampp\htdocs\art-medika\resources\views/project-stock.blade.php ENDPATH**/ ?>