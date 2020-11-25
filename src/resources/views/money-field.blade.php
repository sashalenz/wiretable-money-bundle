<x-wiretable-layout-field :name="$name"
                          :wire-model="$wireModel"
                          :title="$title"
                          :size="$size"
                          :help="$help"
                          :required="$required"
                          :required-icon="$requiredIcon"
                          class="{{ $attributes->whereStartsWith('class')->first() }}"
>
    <div x-data="{ delayed : 0 }" x-init="requestAnimationFrame(() => delayed = 1)">
        <template x-if="delayed">
            <div class="mt-1 relative rounded-md shadow-sm"
                 x-data="{ value: @entangle($wireModel ?? $name) }"
            >
                <input id="{{ $name }}"
                       name="{{ $name }}"
                       type="number"
                       class="form-input block w-full pl-7 pr-12 sm:text-sm sm:leading-5"
                       aria-describedby="{{ $title }}"
                       placeholder="0.00"
                       step="0.01"
                       min="0"
                       :value="value.amount / 100
                       @change="value = { amount: $event.target.value * 100, currency: value.currency }"
                >
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 sm:text-sm sm:leading-5" x-text="value.currency"></span>
                </div>
            </div>
        </template>
    </div>
</x-wiretable-layout-field>
