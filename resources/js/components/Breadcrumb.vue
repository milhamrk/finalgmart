<template>
    <!-- Breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
        <li><router-link :to="{ name: 'home' }"><i class="fa fa-dashboard"></i> Dashboard</router-link></li>
        <li class="active"><span>{{ $route.meta.title }}</span></li>
      </ol>
    </div>
    <!-- /Breadcrumb -->
</template>

<script>
export default {
    
}
</script>