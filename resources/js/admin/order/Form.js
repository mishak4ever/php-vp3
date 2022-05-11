import AppForm from '../app-components/Form/AppForm';

Vue.component('order-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                title:  '' ,
                categories:  '' ,
                products:  '' ,
                cost:  '' ,
                user_id:  '' ,
                active:  false ,
                complete:  false ,
                
            }
        }
    }

});