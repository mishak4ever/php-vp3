@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.product.actions.edit', ['name' => $product->title]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <product-form
                :action="'{{ $product->resource_url }}'"
                :data="{{ $product->toJson() }}"
                :categories="{{$categories->toJson()}}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.product.actions.edit', ['name' => $product->title]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.product.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </product-form>

        </div>
    
</div>

@endsection