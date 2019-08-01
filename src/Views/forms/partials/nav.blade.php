<ul class="nav nav-tabs">
    <li role="presentation" @if($active == "form") class="active" @endif><a href="{{route("voyager.form.edit",[$form->id])}}">Gegevens</a></li>
    <li role="presentation" @if($active == "fields") class="active" @endif><a href="{{route("voyager.form.items",[$form->id])}}">Velden</a></li>
</ul>