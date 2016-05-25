<?php
/**
 * Контроллер AdminAnalizeController
 * Раздел анализа в админпанели
 */
class AdminCategoryController extends AdminBase
{

    /**
     * Action для страницы "Управление категориями"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список категорий
        $categoriesList = Category::getCategoriesListAdmin();

        // Подключаем вид
        require_once(ROOT . '/views/admin_category/index.php');
        return true;
    }
}