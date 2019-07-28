<a class="grid__item" href="{{ $href }}">
    <div class="box">
        <div class="box__shadow"></div>
        <img class="box__img" src="{{ $img }}" alt="cover"/>
        <h3 class="box__title box__title--straight box__title--bottom"><span class="box__title-inner" data-hover="{{ $title }}">{{ $title }}</span>
        </h3>
        <h4 class="box__text box__text--bottom"><span class="box__text-inner box__text-inner--rotated1" style="color: #ea80fc">{{ $tag }}</span></h4>
        <div class="box__deco box__deco--top" style="color: #ff8a80">&#10115;</div>
    </div>
</a>