@php use App\Enum\SymptomTimingType; @endphp

@php
    $pre    = SymptomTimingType::PRE->value;
    $during = SymptomTimingType::DURING->value;
    $post   = SymptomTimingType::POST->value;
@endphp

<div {{ $attributes->merge(['class' => 'w-full max-w-2xl absolute dark:bg-gray-800 grid grid-cols-3 gap-3 shadow-3 p-5 top-[50%] left-[50%] rounded-lg translate-x-[-50%] translate-y-[-50%] z-10 justify-center']) }}
     x-data="additional('{{ $name }}')"
     x-on:show-additional.window="$event.detail == '{{ $name }}' ? onEvent : null"
     x-show="showAdditional"
>

    <x-input-radio x-on:click="onInputClick" name="{{ $name }}" label="{{ __($pre) }}" value="{{ $pre }}" />
    <x-input-radio x-on:click="onInputClick" name="{{ $name }}" label="{{ __($during) }}" value="{{ $during }}"/>
    <x-input-radio x-on:click="onInputClick" name="{{ $name }}" label="{{ __($post) }}" value="{{ $post }}"/>

    <script>

        function additional(name) {

            return {

                inputName: name,
                showAdditional: false,

                onInputClick: function() {
                    setTimeout(() => {
                        this.showAdditional = false
                    },250);
                },

                onEvent: function(e) {

                    if (!e.target instanceof HTMLInputElement) {
                        return;
                    }

                    const target = e.target;

                    if (!target.checked) {
                        document.querySelectorAll(`input[name="${this.inputName}"]`).forEach((item) => {
                            console.log("Hallo", this.inputName);
                            item.checked = null;
                        });
                    }

                    this.showAdditional = !!target.checked;
                }
            };

        }
    </script>

</div>

