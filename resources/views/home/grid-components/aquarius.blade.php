<a class="grid__item" href="{{ $href }}">
    <div class="box">
        <div class="box__shadow"></div>
        <img class="box__img" src="{{ $img }}" alt="cover"/>
        <h3 class="box__title"><span class="box__title-inner" data-hover="{{ $title }}">{{ $title  }}</span></h3>
        <h4 class="box__text"><span class="box__text-inner" style="color: #ff8a80;">{{ $tag }}</span></h4>
        <div class="box__deco box__deco--left">&#10014;</div>
        <p class="box__content">"{{ $content  }}"</p>
    </div>
</a>
