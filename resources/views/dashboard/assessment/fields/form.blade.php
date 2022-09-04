<x-ui::form :route="$route" :name="$formName" :breadcrumbs="$formBreadCrumbs">
    <x-ui::locale.input name="name" :label="__('Name')"/>
    <x-ui::locale.input type="textarea" name="description" :label="__('Description')"/>

</x-ui::form>