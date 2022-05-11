import AppForm from '../app-components/Form/AppForm';
Vue.component('product-form', {
    mixins: [AppForm],
    props: [
        'categories'
    ],
    data: function () {
        return {
            form: {
                title: '',
                category: '',
                price: '',
                description: '',
            },
            mediaCollections: ['product_images']
        }
    }

});
