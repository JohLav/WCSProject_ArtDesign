<?php

    namespace App\Controller;

    use App\Model\ItemManager;
    use App\Model\PlaceManager;

class PlaceController extends AbstractController
{
    /**
     * List places
     */
    public function list(): string
    {
        $placeManager = new PlaceManager();
        $places = $placeManager->selectAll('type');

        return $this->twig->render('place/list.html.twig', ['places' => $places]);
    }

    /**
     * Show informations for a specific place a ne pas utiliser pour ArtDesign
     */
    public function show(int $id): string
    {
        $placeManager = new PlaceManager();
        $place = $placeManager->selectOneById($id);

        return $this->twig->render('place/show.html.twig', ['place' => $place]);
    }

    /**
     * Edit(modifier) a specific item
     */
    public function edit(int $id): ?string
    {
        $itemManager = new ItemManager();
        $item = $itemManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $item = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, update and redirection
            $itemManager->update($item);

            header('Location: /items/show?id=' . $id);

            // we are redirecting so we don't want any content rendered
            return null;
        }

        return $this->twig->render('Item/edit.html.twig', [
            'item' => $item,
        ]);
    }

    /**
     * Add a new item
     */
    public function add(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $place = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $placeManager = new PlaceManager();
            $id = $placeManager->insert($place);
            $chemin = 'Location:/dashboard?id=' . $id;
            header($chemin);
            return null;
        }

        return $this->twig->render('place/add.html.twig');
    }

    /**
     * Delete a specific item
     */
    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $itemManager = new ItemManager();
            $itemManager->delete((int)$id);

            header('Location:/items');
        }
    }
}
