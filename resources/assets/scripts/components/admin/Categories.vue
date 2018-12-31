<template>
    <div class="card card-small mb-3">
        <div class="card-header border-bottom">
            <h6 class="m-0">Categories</h6>
        </div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush" >
                <li class="list-group-item py-2 px-3" v-for="(category, index) in categories" :key="category">
                    <div class="custom-control custom-checkbox mb-1">
                        <input :id="category.slug" type="checkbox" name="categories[]" class="custom-control-input" :value="category.id"/>
                        <label class="custom-control-label" :for="category.slug">{{ category.title }}</label>
                    </div>
                    <ul class="list-group list-group-flush" v-if="category.children">
                        <li class="list-group-item py-1 px-3 border-0" v-for="(child, index) in category.children" :key="child">
                            <div class="custom-control custom-checkbox mb-1">
                                <input :id="child.slug" type="checkbox" name="categories[]" class="custom-control-input" :value="child.id"/>
                                <label class="custom-control-label" :for="child.slug">{{ child.title }}</label>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="list-group-item py-2 px-3">
                    <div class="form-group mb-2">
                        <select class="form-control" v-model="parent">
                            <option disabled value="0">Select Parent</option>
                            <option v-for="(category, index) in categories" :value="category.id">{{ category.title }}</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="New category" aria-label="Add new category" aria-describedby="basic-addon2" v-model="title">
                        <div class="input-group-append">
                            <button class="btn btn-white px-2" type="button" @click="create">
                                <i class="material-icons">add</i>
                            </button>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                parent      : 0,
                title       : '',
                categories  : []
            }
        },
        methods     : {
            read() {
                window.axios.get('/api/categories').then(({ data }) => {
                    data.forEach(category => {
                        if( ! this.type ) {
                            this.categories.push(category);
                        } else {
                            if( this.type == category.type ) {
                                this.categories.push(category);
                            }
                        }
                    });
                }).catch(({ data }) => {
                    console.log(data);
                });
            },
            create() {
                window.axios.post('/api/categories', {
                    parent  : this.parent,
                    title   : this.title,
                    type    : this.type
                }).then(({ data }) => {
                    if( this.parent ) {
                        this.categories.forEach(c => {
                            if( c.id == this.parent ) c.children.push(data);
                        });
                    } else {
                        this.categories.push(data);
                    }

                    this.parent = 0;
                    this.title = '';
                }).catch(({ data }) => {
                    console.log(data);
                });
            },
            delete() {
                this.$emit('delete', this.id);
            }
        },
        created() {
            this.read();
        },
        props       : ['type']
    }
</script>
