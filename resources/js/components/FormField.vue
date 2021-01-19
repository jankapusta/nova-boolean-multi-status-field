<template>
  <default-field :field="field" :errors="errors">
    <template slot="field">
      <table v-if="!field.readonly" class="booleanMultiStatusForm table w-full">
        <tr v-for="(rowData, index) in value">
          <td>
            <input v-if="!useArray" class="form-control form-input form-input-bordered"
                   v-model="value[index]['key']"
                   required
            >
          </td>
          <td>
            <input type="checkbox" class="form-control form-input form-input-bordered"
                   v-model="value[index]['oneValue']"
            >
          </td>
          <td>
            <button class="btn btn-default btn-danger"
                    @click.prevent="removeValue(index)">-
            </button>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <button class="btn btn-default btn-primary" @click.prevent="addValue()">+
            </button>
          </td>
        </tr>
      </table>
      <div v-if="field.readonly" class="relative booleanMultiStatusForm" :class="`text-${field.textAlign}`" :style="`width: ${field.width};`">
        <div v-for="(booleanValue, name) in field.value" class="inline-block" >
          <div class="booleanMultiStatusIcon"
               v-on:mouseenter="mouseenter($event, name)"
               v-on:mousemove.self="mousemove($event)"
               v-on:mouseleave="mouseleave()"
               v-on:mousedown="mousedown($event, name)"
          >
            <boolean-icon style="pointer-events:none;" :key="name" :value="booleanValue" />
          </div>
            </div>
        <div v-if="field.showTooltips && tooltip" class="booleanMultiStatusTooltip absolute 10" :style="`left: ${pos.left}px; top: ${pos.top}px`">
          <div class="w-32 p-2 -mt-1 text-sm leading-tight transform -translate-x-1/2 -translate-y-full bg-80 bg-white rounded-lg shadow-lg">
            <span>{{tooltipKey}}</span>
          </div>
        </div>
      </div>
    </template>
  </default-field>
</template>

<script>
import {FormField, HandlesValidationErrors} from 'laravel-nova'

export default {
  mixins: [FormField, HandlesValidationErrors],
  props: ['resourceName', 'resourceId', 'field', 'tooltip', 'pos', 'tooltipKey', 'useArray'],
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
    },
    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {
      if (this.field.value) {
        this.value = Object.keys(this.field.value)
            .map((index) => {
              return {
                key: index,
                oneValue: this.field.value[index],
              }
            });
      } else {
        this.value = [];
      }
    },

    addValue() {
      this.value.push({
        key: 'new-key',
        oneValue: false,
      });
    },

    removeValue(index) {
      this.value.splice(index, 1);
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill(formData) {
      let dataset;
      if (this.useArray) {
        dataset = this.value.map((one) => {
          return one['oneValue'];
        });
      } else {
        dataset = {};
        this.value.forEach(one => {
          dataset[one['key']] = one['oneValue'];
        });
      }
      formData.append(
          this.field.attribute,
          JSON.stringify(dataset)
      );
    },
  },
  created() {
    this.useArray = Array.isArray(this.field.value);
    if (this.field.readonly) {
      this.field.width = this.field.width ? this.field.width + 'px' : 'auto';
      if (this.field.showTooltips == undefined) {
        this.field.showTooltips = !this.useArray;
      }
      this.tooltip = false;
      this.pos = {
        left:0,
        top:0,
      };
    }
  },
}
</script>
