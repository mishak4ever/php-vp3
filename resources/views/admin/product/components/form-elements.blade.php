<div class="form-group row align-items-center" :class="{'has-danger': errors.has('title'), 'has-success': fields.title && fields.title.valid }">
    <label for="title" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.title') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.title" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('title'), 'form-control-success': fields.title && fields.title.valid}" id="title" name="title" placeholder="{{ trans('admin.product.columns.title') }}">
        <div v-if="errors.has('title')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('title') }}</div>
    </div>
</div>

<!--<div class="form-group row align-items-center" :class="{'has-danger': errors.has('category_id'), 'has-success': fields.category_id && fields.category_id.valid }">
    <label for="category_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.category_id') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.category_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('category_id'), 'form-control-success': fields.category_id && fields.category_id.valid}" id="category_id" name="category_id" placeholder="{{ trans('admin.product.columns.category_id') }}">
        <div v-if="errors.has('category_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('category_id') }}</div>
    </div>
</div>-->

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('category_id'), 'has-success': this.fields.category_id && this.fields.category_id.valid }">
    <label for="category_id"
           class="col-form-label text-md-right col-md-2">Категория</label>
    <div class="col-md-9 col-xl-8">

        <multiselect
            v-model="form.category"
            :options="categories"
            :multiple="false"
            track-by="id"
            label="title"
            tag-placeholder="Выберите категорию"
            placeholder="Категория">
        </multiselect>

        <div v-if="errors.has('category_id')" class="form-control-feedback form-text" v-cloak>@{{
            errors.first('category_id') }}
        </div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('price'), 'has-success': fields.price && fields.price.valid }">
    <label for="price" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.price') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.price" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('price'), 'form-control-success': fields.price && fields.price.valid}" id="price" name="price" placeholder="{{ trans('admin.product.columns.price') }}">
        <div v-if="errors.has('price')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('price') }}</div>
    </div>
</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('product_images'), 'has-success': this.fields.product_images && this.fields.product_images.valid }">
    <label for="product_images"
           class="col-form-label text-md-right col-md-2">&nbsp;</label>
    <div class="col-md-9 col-xl-8">
        @if (isset($mode)&&$mode === 'edit')
        @include('brackets/admin-ui::admin.includes.media-uploader', [
        'mediaCollection' => app(App\Models\Product::class)->getMediaCollection('product_images'),
        'media' => $product->getThumbsForSite('product_images'),
        'label' => 'Изображение'
        ])
        @else
        @include('brackets/admin-ui::admin.includes.media-uploader', [
        'mediaCollection' => app(App\Models\Product::class)->getMediaCollection('product_images'),
        'label' => 'Изображение'
        ])
        @endif
    </div>
</div>

<!--<div class="form-group row align-items-center" :class="{'has-danger': errors.has('image_id'), 'has-success': fields.image_id && fields.image_id.valid }">
    <label for="image_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.image_id') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.image_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('image_id'), 'form-control-success': fields.image_id && fields.image_id.valid}" id="image_id" name="image_id" placeholder="{{ trans('admin.product.columns.image_id') }}">
        <div v-if="errors.has('image_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('image_id') }}</div>
    </div>
</div>-->

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('description'), 'has-success': fields.description && fields.description.valid }">
    <label for="description" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.description') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <wysiwyg v-model="form.description" v-validate="'required'" id="description" name="description" :config="mediaWysiwygConfig"></wysiwyg>
        </div>
        <div v-if="errors.has('description')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('description') }}</div>
    </div>
</div>


