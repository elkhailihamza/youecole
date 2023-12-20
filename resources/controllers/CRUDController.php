<?php

require(__DIR__ . "/../models/CRUDModel.php");
class CRUDController
{
    private $crudModel;
    public function __construct()
    {
        $this->crudModel = new CRUDModel();
    }
    public function getFormateurs()
    {
        $result = $this->crudModel->getFormateurs();

        if (!empty($result)) {
            $i = 0;
            foreach ($result as $row) {
                ?>
                <tr>
                    <th scope="row">
                        <?= ++$i ?>
                    </th>
                    <td>
                        <?= $row['first_name'] ?>
                    </td>
                    <td>
                        <?= $row['last_name'] ?>
                    </td>
                    <td>
                        <?= $row['email'] ?>
                    </td>
                    <td>
                        <?= $row['role_id'] ?>
                    </td>
                    <td>
                        <?= $row['role_name'] ?>
                    </td>
                    <td>
                        <div class="d-flex justify-content-around">
                            <button type="button"
                                class="btn btn-success text-white mb-1 ml-3 py-1 px-1 border-0 d-flex justify-content-center align-items-center"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path>
                                    <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
                                </svg>
                            </button>
                            <button type="button"
                                class="btn btn-danger text-white mb-1 ml-3 py-1 px-1 border-0 d-flex justify-content-center align-items-center"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <td>
                EMPTY
            </td>
            <?php
        }
    }

}