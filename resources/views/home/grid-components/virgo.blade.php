<a class="grid__item" href="{{ $href }}">
    <div class="box">
        <div class="box__shadow"></div>
        <img class="box__img" src="{{ $img }}" alt="Some image"/>
        <h3 class="box__title box__title--straight box__title--left"><span class="box__title-inner" data-hover="{{ $title }}">{{ $title }}</span>
        </h3>
        <h4 class="box__text box__text--bottom box__text--right"><span class="box__text-inner box__text-inner--rotated3">{{ $tag }}</span></h4>
        <div class="box__deco box__deco--top">&#10153;</div>
    </div>
</a>