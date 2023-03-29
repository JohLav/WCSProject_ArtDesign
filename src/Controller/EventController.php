<?php

namespace App\Controller;

use App\Model\EventManager;
use App\Model\ItemManager;
use App\Model\PlaceManager;

class EventController extends AbstractController
{
    /**
     * List event
     */
    public function list(): string
    {
        $eventManager = new EventManager();
        $events = $eventManager->selectAll('name_event');

        return $this->twig->render('event/list.html.twig', ['events' => $events]);
    }

    /**
     * Show informations for a specific event a ne pas utiliser pour ArtDesign
     */
    public function show(int $id): string
    {
        $eventManager = new EventManager();
        $event = $eventManager->selectOneById($id);

        return $this->twig->render('event/show.html.twig', ['event' => $event]);
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
        $planeMnager = new PlaceManager();
        $places = $planeMnager->selectAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $event = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $placeManager = new EventManager();
            $id = $placeManager->insert($event);
            $chemin = 'Location:/dashboard?id=' . $id;
            header($chemin);
            return null;
        }

        return $this->twig->render('event/add.html.twig', ['places' => $places]);
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
