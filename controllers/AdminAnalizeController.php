<?php
/**
 * Контроллер AdminAnalizeController
 * Раздел анализа в админпанели
 */
class AdminAnalizeController extends AdminBase
{

    /**
     * Action для страницы "Анализ магазина"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Подключаем вид
        require_once(ROOT . '/views/admin_analize/index.php');
        return true;
    }
    
    /**
     * Action для страницы "Анализ категории"
     */
    public function actionCategory()
    {
        $categories = Category::getCategoriesList();
        // Подключаем вид
        require_once(ROOT . '/views/admin_analize/category.php');
        return true;
    }
    
}