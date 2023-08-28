<x-mail::message>
# A New Category has been created by this name {{ $category->name }}


Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis repellendus totam voluptatibus architecto perferendis corporis at temporibus ipsa illum dicta. Quod, voluptatum. Dicta sapiente, fuga culpa laudantium voluptas libero atque?
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis repellendus totam voluptatibus architecto perferendis corporis at temporibus ipsa illum dicta. Quod, voluptatum. Dicta sapiente, fuga culpa laudantium voluptas libero atque?
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis repellendus totam voluptatibus architecto perferendis corporis at temporibus ipsa illum dicta. Quod, voluptatum. Dicta sapiente, fuga culpa laudantium voluptas libero atque?


<x-mail::button :url="route('category.show',$category->id)">
View New Category
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
