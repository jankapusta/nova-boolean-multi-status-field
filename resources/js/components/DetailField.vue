<template>
  <panel-item :field="field">
    <template slot="value">
      <div class="booleanMultiStatusDetail" :class="`text-${field.textAlign}`" :style="`width: ${field.width};`">
        <div v-for="(value, name) in field.value" x-data="{ tooltip: false }" class="relative inline-block" >
          <div class="booleanMultiStatusIcon" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false">
            <boolean-icon :key="name" :value="value" />
          </div>
          <div v-if="field.showKeysAsTooltips" class="booleanMultiStatusTooltip absolute top-0 10" x-cloak x-show.transition.origin.top="tooltip">
            <div class="w-32 p-2 -mt-1 text-sm leading-tight transform -translate-x-1/2 -translate-y-full bg-80 bg-white rounded-lg shadow-lg">
              {{name}}
            </div>
          </div>
        </div>
      </div>
    </template>
  </panel-item>
</template>
<script>

export default {
  props: ['resource', 'resourceName', 'resourceId', 'field'],

  created() {
    this.field.value = this.field.value || {}
    this.field.width = this.field.width ? this.field.width + 'px' : 'auto';
    if (this.field.showKeysAsTooltips == undefined) {
      this.field.showKeysAsTooltips = !Array.isArray(this.field.value);
    }
    if (this.field.showKeysAsTooltips) {
      require('alpinejs');
    }
  },
}

</script>
