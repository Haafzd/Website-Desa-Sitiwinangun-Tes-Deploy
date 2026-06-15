<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InventoryItem;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    protected ActivityLogService $logger;

    public function __construct(ActivityLogService $logger)
    {
        $this->logger = $logger;
    }

    public function index(Request $request)
    {
        $query = InventoryItem::query();

        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where('name', 'like', "%{$search}%");
        }

        if ($request->filled('condition')) {
            $query->where('condition', $request->input('condition'));
        }

        $items = $query->latest()->paginate(20)->withQueryString();

        return view('admin.inventory.index', compact('items'));
    }

    public function create()
    {
        return view('admin.inventory.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'condition' => 'required|in:baik,rusak_ringan,rusak_berat',
            'notes' => 'nullable|string',
        ]);

        $item = InventoryItem::create($validated);

        $this->logger->log('create_inventory_item', 'inventory_item', $item->id, null, $item->toArray());

        return redirect()->route('admin.inventory.index')
            ->with('success', 'Barang inventaris berhasil ditambahkan.');
    }

    public function edit(InventoryItem $inventory)
    {
        return view('admin.inventory.edit', ['item' => $inventory]);
    }

    public function update(Request $request, InventoryItem $inventory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'condition' => 'required|in:baik,rusak_ringan,rusak_berat',
            'notes' => 'nullable|string',
        ]);

        $oldData = $inventory->toArray();
        $inventory->update($validated);

        $this->logger->log('update_inventory_item', 'inventory_item', $inventory->id, $oldData, $inventory->toArray());

        return redirect()->route('admin.inventory.index')
            ->with('success', 'Barang inventaris berhasil diperbarui.');
    }

    public function destroy(InventoryItem $inventory)
    {
        $oldData = $inventory->toArray();
        $inventory->delete();

        $this->logger->log('delete_inventory_item', 'inventory_item', $inventory->id, $oldData, null);

        return redirect()->route('admin.inventory.index')
            ->with('success', 'Barang inventaris berhasil dihapus.');
    }
}
