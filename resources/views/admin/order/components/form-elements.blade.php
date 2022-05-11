<div class="form-group row align-items-center" :class="{'has-danger': errors.has('title'), 'has-success': fields.title && fields.title.valid }">
    <label for="title" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.title') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.title" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('title'), 'form-control-success': fields.title && fields.title.valid}" id="title" name="title" placeholder="{{ trans('admin.order.columns.title') }}">
        <div v-if="errors.has('title')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('title') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('categories'), 'has-success': fields.categories && fields.categories.valid }">
    <label for="categories" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.categories') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.categories" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('categories'), 'form-control-success': fields.categories && fields.categories.valid}" id="categories" name="categories" placeholder="{{ trans('admin.order.columns.categories') }}">
        <div v-if="errors.has('categories')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('categories') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('products'), 'has-success': fields.products && fields.products.valid }">
    <label for="products" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.products') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.products" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('products'), 'form-control-success': fields.products && fields.products.valid}" id="products" name="products" placeholder="{{ trans('admin.order.columns.products') }}">
        <div v-if="errors.has('products')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('products') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('cost'), 'has-success': fields.cost && fields.cost.valid }">
    <label for="cost" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.cost') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.cost" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('cost'), 'form-control-success': fields.cost && fields.cost.valid}" id="cost" name="cost" placeholder="{{ trans('admin.order.columns.cost') }}">
        <div v-if="errors.has('cost')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('cost') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('user_id'), 'has-success': fields.user_id && fields.user_id.valid }">
    <label for="user_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.user_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.user_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('user_id'), 'form-control-success': fields.user_id && fields.user_id.valid}" id="user_id" name="user_id" placeholder="{{ trans('admin.order.columns.user_id') }}">
        <div v-if="errors.has('user_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('user_id') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('active'), 'has-success': fields.active && fields.active.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="active" type="checkbox" v-model="form.active" v-validate="''" data-vv-name="active"  name="active_fake_element">
        <label class="form-check-label" for="active">
            {{ trans('admin.order.columns.active') }}
        </label>
        <input type="hidden" name="active" :value="form.active">
        <div v-if="errors.has('active')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('active') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('complete'), 'has-success': fields.complete && fields.complete.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="complete" type="checkbox" v-model="form.complete" v-validate="''" data-vv-name="complete"  name="complete_fake_element">
        <label class="form-check-label" for="complete">
            {{ trans('admin.order.columns.complete') }}
        </label>
        <input type="hidden" name="complete" :value="form.complete">
        <div v-if="errors.has('complete')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('complete') }}</div>
    </div>
</div>


