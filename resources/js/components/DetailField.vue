<template>
  <panel-item :field="field">
    <template slot="value">
      <div class="relative booleanMultiStatusDetail" :class="`text-${field.textAlign}`" :style="`width: ${field.width};`">
        <div v-for="(value, name) in field.value" class="inline-block" >
          <div class="booleanMultiStatusIcon"
               v-on:mouseenter="mouseenter($event, name)"
               v-on:mousemove.self="mousemove($event)"
               v-on:mouseleave="mouseleave()"
               v-on:mousedown="mousedown($event, name)"
          >
            <boolean-icon style="pointer-events:none;" :key="name" :value="value" />
          </div>
        </div>
        <div v-if="field.showTooltips && tooltip" class="booleanMultiStatusTooltip absolute 10" :style="`left: ${pos.left}px; top: ${pos.top}px`">
          <div class="w-32 p-2 -mt-1 text-sm leading-tight transform -translate-x-1/2 -translate-y-full bg-80 bg-white rounded-lg shadow-lg">
            <span>{{tooltipKey}}</span>
          </div>
        </div>
      </div>
    </template>
  </panel-item>
</template>
<script>

export default {
  props: ['resource', 'resourceName', 'resourceId', 'field', 'tooltip', 'pos', 'tooltipKey', 'useArray'],
  methods: {
    mousedown: function (ev, textKey) {
      this.tooltip = !this.tooltip;
      this.tooltipKey = textKey;
      this.pos = {
        left: ev.layerX + 15,
        top: ev.layerY + 15,
      };
    },
    mouseenter: function(ev, textKey) {
      this.tooltip = true;
      this.tooltipKey = textKey;
      this.pos = {
        left: ev.layerX + 15,
        top: ev.layerY + 15,
      };
    },
    mousemove: function(ev) {
      this.pos = {
        left: ev.layerX + 15,
        top: ev.layerY + 15,
      };
    },
    mouseleave: function() {
      this.tooltip = false;
    }
  },
  created() {
    this.field.value = this.field.value || {}
    this.field.width = this.field.width ? this.field.width + 'px' : 'auto';
    if (this.field.showTooltips == undefined) {
      this.field.showTooltips = !Array.isArray(this.field.value);
    }
    this.tooltip = false;
    this.pos = {
      left:0,
      top:0,
    };
  },
}

</script>
