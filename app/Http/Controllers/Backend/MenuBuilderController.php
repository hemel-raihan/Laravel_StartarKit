<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class MenuBuilderController extends Controller
{
    public function index($id)
    {
        Gate::authorize('app.menus.index');
        $auth = Auth::user();
        $menu = Menu::findOrFail($id);
        return view('backend.menus.builder',compact('menu','auth'));
    }

    public function order(Request $request, $id)
    {
        Gate::authorize('app.menus.index');
        $auth = Auth::user();
        $menuItemOrder = json_decode($request->get('order'));
        $this->orderMenu($menuItemOrder,null);
    }

    private function orderMenu(array $menuItems, $parentId)
    {
        foreach($menuItems as $index => $item)
        {
            $menuItem = MenuItem::findOrFail($item->id);
            $menuItem->update([
                'order' => $index + 1,
                'parent_id' => $parentId
            ]);

            if(isset($item->children))
            {
                $this->orderMenu($item->children,$menuItem->id);
            }
        }
    }

    public function itemCreate($id)
    {
        Gate::authorize('app.menus.create');
        $auth = Auth::user();
        $menu = Menu::findOrFail($id);
        return view('backend.menus.item.create',compact('menu','auth'));
    }

    public function itemStore(Request $request,$id)
    {
        Gate::authorize('app.menus.create');

        $this->validate($request,[
            'type' => 'required|string',
            'divider_title' => 'nullable|string',
            'title' => 'nullable|string',
            'url' => 'nullable|string',
            'target' => 'nullable|string',
            'icon_class' => 'nullable|string',
        ]);
        $menu = Menu::findOrFail($id);

        $menu->menuItems()->create([
            'title' => $request->title,
            'type' => $request->type,
            'divider_title' => $request->divider_title,
            'url' => $request->url,
            'target' => $request->target,
            'icon_class' => $request->icon_class,
        ]);

        notify()->success('Menu Item Added','Added');
        return redirect()->route('app.menus.builder',$menu->id);
    }

    public function itemEdit($id,$itemId)
    {
        Gate::authorize('app.menus.edit');
        $auth = Auth::user();
        $menu = Menu::findOrFail($id);
        $menuItem = $menu->menuItems()->findOrFail($itemId);
        return view('backend.menus.item.create',compact('menu','auth','menuItem'));
    }

    public function itemUpdate(Request $request,$id,$itemId)
    {
        Gate::authorize('app.menus.edit');

        $this->validate($request,[
            'type' => 'required|string',
            'divider_title' => 'nullable|string',
            'title' => 'nullable|string',
            'url' => 'nullable|string',
            'target' => 'nullable|string',
            'icon_class' => 'nullable|string',
        ]);
        $menu = Menu::findOrFail($id);

        $menu->menuItems()->findOrFail($itemId)->update([
            'title' => $request->title,
            'type' => $request->type,
            'divider_title' => $request->divider_title,
            'url' => $request->url,
            'target' => $request->target,
            'icon_class' => $request->icon_class,
        ]);

        notify()->success('Menu Item Updated','Update');
        return redirect()->route('app.menus.builder',$menu->id);
    }

    public function itemDestroy($id,$itemId)
    {
        Gate::authorize('app.menus.destroy');

        Menu::findOrFail($id)
             ->menuItems()
             ->findOrFail($itemId)
             ->delete();

             notify()->success('Menu Item Deleted','Deleted');
             return back();

    }
}
