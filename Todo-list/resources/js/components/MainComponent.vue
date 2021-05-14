<template>
  <div class="row">
    <div class="col-4 p-1">
      <create-component v-on:submit-form="getData"></create-component>
    </div>
    <div class="col-8 p-1">

      <div class="bg-white p-1 rounded shadow">
        <button class="btn btn-outline-primary" v-on:click="waitBtn">Bekleyenler</button>
        <button class="btn btn-outline-success" v-on:click="completeBtn">Tamamlananlar</button>
        <button class="btn btn-outline-danger" v-on:click="cancelBtn">İptal Edilenler</button>
      </div>

      <div class="" v-if="waitDiv">
        <wait-component v-on:cancel-content="getCancel" v-on:complete-content="getComplete" v-bind:contents="contents"></wait-component>
      </div>

      <div class="" v-if="completeDiv">
        <complete-component v-on:cancel-content="getCompToCancel" v-bind:contents="complete"></complete-component>
      </div>

      <div class="" v-if="cancelDiv">
        <cancel-component v-on:complete-content="getCompToCancel" v-bind:contents="cancel"></cancel-component>
      </div>

    </div>
  </div>
</template>

<script>
  export default{
    mounted(){//Verileri çekme -- VUE YÜKLENDİĞİNDEN İTİBAREN
      //Bekleyenlerin Yüklenmesi
      axios.get('http://localhost:8000/api/index')
      .then((res)=>{
        this.contents = res.data;
      })
      //Tamamlananların Yüklenmesi
      axios.get('http://localhost:8000/api/complete')
      .then((res)=>{
        this.complete = res.data;
      })
      //İptal Edilenlerin Yüklenmesi
      axios.get('http://localhost:8000/api/cancel')
      .then((res)=>{
        this.cancel = res.data;
      })
    },

    data(){
      return{
        contents:[],
        complete:[],
        cancel:[],
        waitDiv:true,
        completeDiv:false,
        cancelDiv:false
      }
    },
    methods:{
      //Yeni Oluşturulunca Bekleyenlerin Yeniden Yüklenmesi
      getData:function(){
        axios.get('http://localhost:8000/api/index')
        .then((res)=>{
          this.contents = res.data;
        })
      },
      //Tamamlanınca Bekleyen Ve Tamamlananların yeniden yüklenmesi
      getComplete:function(){
        axios.get('http://localhost:8000/api/index')
        .then((res)=>{
          this.contents = res.data;
        })
        axios.get('http://localhost:8000/api/complete')
        .then((res)=>{
          this.complete = res.data;
        })
      },
      //İptal Edilince Bekleyen Ve İptal Edilenlerin yeniden yüklenmesi
      getCancel:function(){
        axios.get('http://localhost:8000/api/index')
        .then((res)=>{
          this.contents = res.data;
        })
        axios.get('http://localhost:8000/api/cancel')
        .then((res)=>{
          this.cancel = res.data;
        })
      },
      //Tamamlanan İptal Edilince
      getCompToCancel:function(){
        axios.get('http://localhost:8000/api/complete')
        .then((res)=>{
          this.complete = res.data;
        })
        axios.get('http://localhost:8000/api/cancel')
        .then((res)=>{
          this.cancel = res.data;
        })
      },
      //Bekleyenler Kısmı
      waitBtn:function(){
        this.waitDiv = true
        this.completeDiv = false
        this.cancelDiv = false
      },
      //Tamamlananlar Kısmı
      completeBtn:function(){
        this.waitDiv = false
        this.completeDiv = true
        this.cancelDiv = false
      },
      //İptal Edilenler Kısmı
      cancelBtn:function(){
        this.waitDiv = false
        this.completeDiv = false
        this.cancelDiv = true
      }
    }
  }
</script>
