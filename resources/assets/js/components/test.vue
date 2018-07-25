<template>

  <div>
  <label class="typo__label">Simple select / dropdown</label>
  <multiselect @submit.prevent="onSubmit" v-model="value" :options="options" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" placeholder="Pick some" :custom-label="categories" :preselect-first="false"> 
  </multiselect>

  </div>
  

</template>

<script>
import Multiselect from 'vue-multiselect'

export default {
  name: 'app',
  components: {
    Multiselect
  },
  data () {
    return {
      value: [],
      options: []
    }
  },
   mounted () {
    axios.get(`http://localhost/Test_laravel/public/api/categories`)
    .then(response => {
      this.options = response.data
    })
    .catch(e => {
      this.errors.push(e)
    })
    },
   methods: {
    categories ({ name }) {
      return `${name} `
    },
    onSubmit(){
         axios.post('/http://localhost/Test_laravel/public/posts', this.$data)
         .then(response => alert('Success'))
         .catch(e => {
           this.errors.push(e)
         })
    }
   }
}

</script>
