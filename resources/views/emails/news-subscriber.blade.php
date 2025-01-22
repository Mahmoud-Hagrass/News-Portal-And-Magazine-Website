<x-mail::message>
# Thank You For Subscribe !

You are welcome

<x-mail::button :url="route('frontend.index')">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
