<style>
    body {
        font-family:Arial,Helvetica,sans-serif;
    }
    p{
        font-weight: 600;
        font-size: 24px;
        color:red;
    }

</style>


<p>Category: {{ $category->name }} Created</p>
<p>
    <a href="{{ route('category.show',$category->id) }}">
        {{ $category->name }}
    </a>
</p>
