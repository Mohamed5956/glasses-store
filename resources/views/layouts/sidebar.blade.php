<nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0"
    id="navbar-vertical">
    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
        @foreach ($categories as $category)
            <div class="nav-item dropdown">
                <a href="#" class="nav-link" data-toggle="dropdown">{{ $category->name }} <i
                        class="fa fa-angle-down float-right mt-1"></i></a>
                <div class="dropdown-menu position-static bg-secondary border-0 rounded-0 w-100 m-0"
                    id="dropdown-{{ $category->id }}">
                    @if (count($category->subcategory) > 0)
                        @foreach ($category->subcategory as $subcategory)
                            <a href="{{ route('subcategory.show', $subcategory->id) }}"
                                class="dropdown-item">{{ $subcategory->name }}</a>
                        @endforeach
                    @else
                        <p class="text-center">No subcategories found</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</nav>
