Nova.booting((Vue, router, store) => {
  Vue.component('index-nova-boolean-multi-status-field', require('./components/IndexField'))
  Vue.component('detail-nova-boolean-multi-status-field', require('./components/DetailField'))
  Vue.component('form-nova-boolean-multi-status-field', require('./components/FormField'))
})
