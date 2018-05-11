<template>
    <div>

        <div class="row">
            <div class="col-xs-12">
            <h2 @click="isClicked" class="editable" v-html="userDetail.first_name+' '+userDetail.last_name">Almas</h2>
            <div class="form-inline" v-if="clicked__">
                <div class="form-group">
                <input class="form-field form-control bgwhite input-sm" type="text" v-model="userDetail.first_name" placeholder="First Name"/>
                </div>

                <div class="form-group">
                <input class="form-field form-control bgwhite input-sm" type="text" v-model="userDetail.last_name"/>
                </div>


            </div>
            </div>

            <div class="form col-xs-6">
                <h4 @click="isClicked" v-html="userDetail.designation"></h4>
                <div class="form-group-sm" v-if="clicked__">
                <input class="form-field form-control bgwhite input-sm" type="text" v-model="userDetail.designation" placeholder="designation"/>
                </div>
                <h5 @click="isClicked" v-html="userDetail.organization"></h5>
                <div class="form-group-sm" v-if="clicked__">
                <input class="form-field form-control bgwhite input-sm" type="text" v-model="userDetail.organization" placeholder="organization"/>
                </div>
                <!--<button v-if="clicked__" class="btn btn-xs" @click.prevent="GetData" >Save</button>-->

            </div>


        </div>

        <div>


        </div>

    </div>
</template>

<script>


    export default {
        props: ['info'],
        data(){
            return{
                userDetail:{
                    first_name: this.info.first_name,
                    last_name: this.info.last_name,
                    organization: this.info.organization,
                    designation: this.info.designation
                },
                clicked__:false
            }
        },
        methods:{
            GetData:function(){
                // console.log(this.userDetail.first_name+" :: "+this.userDetail.last_name+" :: "+this.userDetail.organization+" :: "+this.userDetail.designation)
                this.clicked__ = false;
                const userExport = this.userDetail;
                return userExport;
            },
            isClicked:function(){
                this.clicked__ = true;
                this.$eventBus.$emit('message', this.clicked__);
            },
            cancelEdit:function(){
                this.clicked__ = false;
            },

        }
    }
</script>

<style scoped>

</style>

<!--https://codepen.io/izobiz/pen/vgeWaY-->