<a class="grid__item" href="{{ $href }}">
    <div class="box">
        <div class="box__shadow"></div>
        <img class="box__img" src="{{ $img }}" alt="Some image"/>
        <h3 class="box__title box__title--bottom"><span class="box__title-inner" data-hover="{{ $title }}">{{ $title }}</span></h3>
        <h4 class="box__text"><span class="box__text-inner box__text-inner--rotated2">{{ $tag }}</span></h4>
        <p class="box__content">"{{ $content }}"</p>
    </div>
</a>