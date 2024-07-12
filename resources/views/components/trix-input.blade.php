@props(['id', 'name', 'value' => '', 'toolbar' => ''])

<input
    type="hidden"
    name="{{ $name }}"
    id="{{ $id }}_input"
    value="{{ $value }}"
/>

<trix-toolbar
    @class([
        "[&_.trix-button]:bg-white [&_.trix-button.trix-active]:bg-gray-300",
        "[&_.trix-button-group:not(.trix-button-group--text-tools)]:hidden [&_.trix-button--icon-strike]:hidden" => $toolbar === 'mini',
    ])
    id="{{ $id }}_toolbar"
></trix-toolbar>

<trix-editor
    id="{{ $id }}"
    toolbar="{{ $id }}_toolbar"
    input="{{ $id }}_input"
    @if ($toolbar === 'mini')
    x-data=""
    x-on:trix-file-accept.prevent
    x-on:trix-attachment-add="$event.attachment.file && $event.attachment.remove()"
    @endif
    {{ $attributes->merge(['class' => 'trix-content border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:ring-1 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm dark:[&_pre]:!bg-gray-700 dark:[&_pre]:rounded dark:[&_pre]:!text-white']) }}
></trix-editor>
